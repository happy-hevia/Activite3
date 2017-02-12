<?php
namespace App\Frontend\Modules\News;

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

    $listeNews = $manager->getList($nombreNews * ($page - 1), $nombreNews);

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
    $totalArticle = $manager->count();
    $nbrePage = round($totalArticle / $nombreNews);


    $this->page = $this->twig->render("module/accueil.twig", array("title" => 'Liste des ' . $nombreNews . ' dernières news', "listeNews" => $listeNews, "page" => $page, "nbrePage" => $nbrePage));
  }
  
  public function executeShow(HTTPRequest $request)
  {
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
    
    if (empty($news))
    {
      $this->app->httpResponse()->redirect404();
    }

    $this->page = $this->twig->render('module/show.twig', array('news' => $news, "comments" => $this->managers->getmanagerOf('Comments')->getListOf($news->id())));
    
//    $this->page->addVar('title', $news->titre());
//    $this->page->addvar('news', $news);
//    $this->page->addvar('comments', $this->managers->getmanagerOf('Comments')->getListOf($news->id()));
  }

  public function executeInsertComment(HTTPRequest $request)
  {
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'news' => $request->getData('news'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = new Comment;
    }

    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();

    $form = $formBuilder->form();

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
      
      $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');
    }

    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
  }

  public function executeAPropos(HTTPRequest $request)
  {
    $this->page = $this->twig->render('module/a-propos.twig');
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
