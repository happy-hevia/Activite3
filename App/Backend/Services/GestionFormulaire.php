<?php

namespace App\Backend\Services;

use Entity\News;
use Gregwar\Formidable\Form;
use Gregwar\Formidable\Language\French;


/**
 * Created by PhpStorm.
 * User: Jérémie
 * Date: 14/02/2017
 * Time: 21:05
 */
class GestionFormulaire
{
    public static function creationFormulaireAjoutArticle()
    {
        $form = new Form(__DIR__ . '/../Templates/modules/formulaire/form-ajouter-article.html');

        $form->setLanguage(new French);

        return $form;
    }

    public static function creationFormulaireModificationArticle()
    {
        $form = new Form(__DIR__ . '/../Templates/modules/formulaire/form-modifier-article.html');

        $form->setLanguage(new French);

        return $form;
    }

}
