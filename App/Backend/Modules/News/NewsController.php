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

        $this->page = $this->twig->render('@admin/modules/articles-liste.twig', array('listeArticles' => $listeArticles));
    }

    public function executeArticlesModifier(HTTPRequest $request)
    {
        $article = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

        $this->page = $this->twig->render('@admin/modules/articles-modifier.twig', array('article' => $article));
    }

    public function executeArticlesAjouter(HTTPRequest $request)
    {
        $news = new News();
        $form = GestionFormulaire::creationFormulaireAjoutArticle();
        $form->setData($news);

        $errors = array();
        if ($form->posted() && !$form->check()) {
            $article = $form->getData($news);
            $article->setAuteur("Jean Forteroche");

            $this->managers->getManagerOf('News')->add($article);
        } else if ($form->posted() && $form->check()) {
            $errors = $form->check();
        }




        $this->page = $this->twig->render('@admin/modules/articles-ajouter.twig', array('form' => $form, 'errors' => $errors));
    }

    public function executeCommentairesListe(HTTPRequest $request)
    {
        $listeCommentaires = $this->managers->getManagerOf('Comments')->getAll();

        $this->page = $this->twig->render('@admin/modules/commentaires-liste.twig', array('listeCommentaires' => $listeCommentaires));
    }

    public function executeCommentairesModifier(HTTPRequest $request)
    {

        $commentaire = $this->managers->getManagerOf('Comments')->get($request->getData('id'));

        $this->page = $this->twig->render('@admin/modules/commentaires-modifier.twig', array('commentaire' => $commentaire));
    }


    public function executeDelete(HTTPRequest $request)
    {
        $newsId = $request->getData('id');

        $this->managers->getManagerOf('News')->delete($newsId);
        $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);

        $this->app->user()->setFlash('La news a bien été supprimée !');

        $this->app->httpResponse()->redirect('.');
    }

    public function executeDeleteComment(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comments')->delete($request->getData('id'));

        $this->app->user()->setFlash('Le commentaire a bien été supprimé !');

        $this->app->httpResponse()->redirect('.');
    }

    public function executeIndex(HTTPRequest $request)
    {

        $managerNews = $this->managers->getManagerOf('News');
        $nbreArticles = $managerNews->count();

        $managerComments = $this->managers->getManagerOf('Comments');
        $nbreComments = $managerComments->count();
        $nbreNotifie = $managerComments->countNotifie();

        $this->page = $this->twig->render('@admin/modules/index.twig', array('nbreArticles' => $nbreArticles, 'nbreComments' => $nbreComments, 'nbreNotifie' => $nbreNotifie));
    }

    public function executeInsert(HTTPRequest $request)
    {
        $this->processForm($request);

        $this->page->addVar('title', 'Ajout d\'une news');
    }

    public function executeUpdate(HTTPRequest $request)
    {
        $this->processForm($request);

        $this->page->addVar('title', 'Modification d\'une news');
    }

    public function executeUpdateComment(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Modification d\'un commentaire');

        if ($request->method() == 'POST') {
            $comment = new Comment(['id' => $request->getData('id'), 'auteur' => $request->postData('auteur'), 'contenu' => $request->postData('contenu')]);
        } else {
            $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
        }

        $formBuilder = new CommentFormBuilder($comment);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

        if ($formHandler->process()) {
            $this->app->user()->setFlash('Le commentaire a bien été modifié');

            $this->app->httpResponse()->redirect('/admin/');
        }

        $this->page->addVar('form', $form->createView());
    }

    public function processForm(HTTPRequest $request)
    {
        if ($request->method() == 'POST') {
            $news = new News(['auteur' => $request->postData('auteur'), 'titre' => $request->postData('titre'), 'contenu' => $request->postData('contenu')]);

            if ($request->getExists('id')) {
                $news->setId($request->getData('id'));
            }
        } else {
            // L'identifiant de la news est transmis si on veut la modifier
            if ($request->getExists('id')) {
                $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
            } else {
                $news = new News;
            }
        }

        $formBuilder = new NewsFormBuilder($news);
        $formBuilder->build();

        $form = $formBuilder->form();

        $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);

        if ($formHandler->process()) {
            $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !');

            $this->app->httpResponse()->redirect('/admin/');
        }

        $this->page->addVar('form', $form->createView());
    }
}
