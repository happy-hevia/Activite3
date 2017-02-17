<?php
namespace App\Backend\Modules\News;

use App\Backend\Services\GestionFormulaire;
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\News;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \OCFram\FormHandler;

class NewsController extends BackController
{

    public function executeArticlesListe(HTTPRequest $request)
    {

        $listeArticles = $this->managers->getManagerOf('News')->getList();

        $this->page = $this->twig->render('@admin/modules/articles-liste.twig', array('listeArticles' => $listeArticles, 'flash' => $this->app()->user()->getFlash()));
    }

    public function executeArticlePublier(HTTPRequest $request)
    {
        $article = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
        $article->setPublicated(!$article->publicated());

        $this->managers->getManagerOf('News')->modify($article);

        if ($article->publicated()) {
            $this->app->user()->setFlash("L'article est maintenant publié");
        } else {
            $this->app->user()->setFlash("L'article n'est maintenant plus publié");
        }

        $this->app->httpResponse()->redirect('/admin/articles/liste');
    }

    public function executeArticlesModifier(HTTPRequest $request)
    {
        $form = GestionFormulaire::creationFormulaireModificationArticle();

        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

        if (empty($news))
        {
            $this->app->httpResponse()->setPage($this->twig->render('module/error404.twig'));
            $this->app->httpResponse()->redirect404();
        }

        $form->setData($news);

        if ($form->posted() && !$form->check()) {
            $article = $form->getData($news);
            $article->setAuteur("Jean Forteroche");

            $this->managers->getManagerOf('News')->modify($article);

            $this->app->user()->setFlash("L'article a été modifié avec succès");
            $this->app->httpResponse()->redirect('/admin/articles/liste');

        } else if ($form->posted() && $form->check()) {
            $errors = $form->check();
            $this->page = $this->twig->render('@admin/modules/articles-modifier.twig', array('form' => $form, 'errors' => $errors));
        } else {
            $this->page = $this->twig->render('@admin/modules/articles-modifier.twig', array('form' => $form));
        }
    }

    public function executeArticlesAjouter(HTTPRequest $request)
    {
        $form = GestionFormulaire::creationFormulaireAjoutArticle();

        $news = new News();

        if ($form->posted() && !$form->check()) {
            $article = $form->getData($news);
            $article->setAuteur($this->app()->config()->get('auteur'));

            $this->managers->getManagerOf('News')->add($article);

            $this->app->user()->setFlash("L'article a été ajouté avec succès");
            $this->app->httpResponse()->redirect('/admin/articles/liste');

        } else if ($form->posted() && $form->check()) {
            $errors = $form->check();
            $this->page = $this->twig->render('@admin/modules/articles-ajouter.twig', array('form' => $form, 'errors' => $errors));
        } else {
            $this->page = $this->twig->render('@admin/modules/articles-ajouter.twig', array('form' => $form));
        }
    }

    public function executeCommentairesListe(HTTPRequest $request)
    {
        $listeCommentaires = $this->managers->getManagerOf('Comments')->getAll();

        $this->page = $this->twig->render('@admin/modules/commentaires-liste.twig', array('listeCommentaires' => $listeCommentaires, 'flash' => $this->app()->user()->getFlash()));
    }

    public function executeCommentairesModifier(HTTPRequest $request)
    {
        $form = GestionFormulaire::creationFormulaireModificationCommentaire();

        $commentaire = $this->managers->getManagerOf('Comments')->get($request->getData('id'));

        if (empty($commentaire))
        {
            $this->app->httpResponse()->setPage($this->twig->render('module/error404.twig'));
            $this->app->httpResponse()->redirect404();
        }

        $form->setData($commentaire);

        if ($form->posted() && !$form->check()) {
            $commentaire = $form->getData($commentaire);

            $this->managers->getManagerOf('Comments')->modify($commentaire);

            $this->app->user()->setFlash("Le commenatire a été modifié avec succès");
            $this->app->httpResponse()->redirect('/admin/commentaires/liste');

        } else if ($form->posted() && $form->check()) {
            $errors = $form->check();
            $this->page = $this->twig->render('@admin/modules/commentaires-modifier.twig', array('form' => $form, 'errors' => $errors));
        } else {
            $this->page = $this->twig->render('@admin/modules/commentaires-modifier.twig', array('form' => $form));
        }
    }


    public function executeArticleSupprimer(HTTPRequest $request)
    {
        $newsId = $request->getData('id');

        $this->managers->getManagerOf('News')->delete($newsId);
        $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);

        $this->app->user()->setFlash("L'article a été supprimé avec succès");

        $this->app->httpResponse()->redirect('/admin/articles/liste');
    }

    public function executeCommentaireSupprimer(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comments')->delete($request->getData('id'));

        $this->app->user()->setFlash('Le commentaire a bien été supprimé !');

        $this->app->httpResponse()->redirect('/admin/commentaires/liste');
    }

    public function executeIndex(HTTPRequest $request)
    {

        $managerNews = $this->managers->getManagerOf('News');
        $nbreArticles = $managerNews->count();

        $managerComments = $this->managers->getManagerOf('Comments');
        $nbreComments = $managerComments->count();
        $nbreNotifie = $managerComments->countNotifie();

        $this->page = $this->twig->render('@admin/modules/index.twig', array('nbreArticles' => $nbreArticles, 'nbreComments' => $nbreComments, 'nbreNotifie' => $nbreNotifie, 'flash' => $this->app()->user()->getFlash()));
    }
}
