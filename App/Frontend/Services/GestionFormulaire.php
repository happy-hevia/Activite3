<?php

namespace App\Frontend\Services;

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
    public static function creationFormulaireAjoutCommentaire()
    {
        $form = new Form(__DIR__ . '/../Templates/module/formulaire/form-ajouter-commentaire.twig');

        $form->setLanguage(new French);

        return $form;
    }

}
