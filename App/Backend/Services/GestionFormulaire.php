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
        // Formidable will parse the form and use it to check integrity
        // on the server-side
        $form = new Form('
            <form id="form-ajouter-article" method="post" data-parsley-validate class="form-horizontal form-label-left" >
    <div class="form-group" >
        <label class="col-xs-12" for="titre" >Titre
            <span class="required" >*</span >
        </label >
        <div class="col-xs-12" >
            <input type="text" mapping="titre"   name="titre" id="titre" maxlength="40" minlength="6" required="required" class="form-control" >
        </div >
    </div >
    <div class="form-group" >
        <label class="col-xs-12" for="contenu" >Contenu
            <span class="required" >*</span >
        </label >
        <div class="col-xs-12" >
            <textarea id="contenu" mapping="contenu" name="contenu" maxlength="10000" minlength="100" required="required" class="form-control" ></textarea >
        </div >
    </div >
    <div class="checkbox" >
        <label >
            <div  style="position: relative;" >
                <input name="publicated" type="checkbox" mapping="publicated" value="true" >
            </div >
            Publier maintenant
        </label >
    </div >
    <div class="ln_solid" ></div >
    <div class="form-group" >
        <div class="col-md-6 col-sm-6 col-xs-12" >
            <button type="submit" class="btn btn-lg btn-success" >Créer</button >
        </div >
    </div >

</form>
        ');


        $form->setLanguage(new French);

        return $form;
    }

}
