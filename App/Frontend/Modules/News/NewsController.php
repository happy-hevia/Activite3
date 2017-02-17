<?php
namespace App\Frontend\Modules\News;

use App\Frontend\Services\GestionCommentaires;
use App\Frontend\Services\GestionFormulaire;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;
use \OCFram\BackController;

class NewsController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {

    $nombreNews = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
    

    // On récupère le manager des news.
    $manager = $this->managers->getManagerOf('News');

//    Je récupère la page
    $page = $request->getData('page') ? $request->getData('page') : 1;

    $listeNews = $manager->getListPublicated($nombreNews * ($page - 1), $nombreNews);

    foreach ($listeNews as $news)
    {
      if (strlen($news->contenu()) > $nombreCaracteres)
      {
        $debut = substr($news->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
        
        $news->setContenu($debut);
      }
    }

//    calcule le nombre total de page
    $totalArticle = $manager->countPublicated();
    $nbrePage = round($totalArticle / $nombreNews);


    $this->page = $this->twig->render("module/accueil.twig", array("title" => 'Liste des ' . $nombreNews . ' dernières news', "listeNews" => $listeNews, "page" => $page, "nbrePage" => $nbrePage));
  }
  
  public function executeShow(HTTPRequest $request)
  {
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
    
    if (empty($news))
    {
      $this->app->httpResponse()->setPage($this->twig->render('module/error404.twig'));
      $this->app->httpResponse()->redirect404();
    }

    $form = GestionFormulaire::creationFormulaireAjoutCommentaire();

    $listeCommentaires = $this->managers->getmanagerof('Comments')->getlistof($news->id());

    $listeCommentairestrie = GestionCommentaires::tricommentairesselonniveau($listeCommentaires);


    $commentaire = new Comment();
    if ($form->posted() && !$form->check()) {
      $nouveauCommentaire = $form->getdata($commentaire);
      $nouveauCommentaire->setnews($request->getdata('id'));
      $this->managers->getmanagerof('Comments')->add($nouveauCommentaire);
      $this->app->user()->setflash("le commenatire a été créé avec succès");

      $nouveauCommentaire = new Comment();
      $form->setData($nouveauCommentaire);

      $this->page = $this->twig->render('module/show.twig', array('news' => $news, "comments" => $listeCommentairestrie, 'form' => $form, 'flash' => $this->app->user()->getFlash() ));

    } else if ($form->posted() && $form->check()) {
      $errors = $form->check();
      $this->page = $this->twig->render('module/show.twig', array('form' => $form, 'errors' => $errors));
    } else {
      $this->page = $this->twig->render('module/show.twig', array('news' => $news, "comments" => $listeCommentairestrie, 'form' => $form));
    }

  }


  public function executeAPropos(HTTPRequest $request)
  {
    $this->page = $this->twig->render('module/a-propos.twig');
  }

  public function executeNotifieCommentaire(HTTPRequest $request)
  {
    $manager = $this->managers->getManagerOf('Comments');
    $commentaire = $manager->get($request->getData('commentaire'));
    $commentaire->setNotifie(true);
    $manager->modify($commentaire);

    $this->app->user()->setFlash('Le commentaire a bien été notifié');
    $this->app->httpResponse()->redirect('/');

  }

  public function executeHistoire(HTTPRequest $request)
  {
    $this->page = $this->twig->render('module/histoire.twig');
  }

  public function executeTerms(HTTPRequest $request)
  {
    $this->page = $this->twig->render('module/terms.twig');
  }
}
