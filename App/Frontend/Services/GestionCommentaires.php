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
class GestionCommentaires
{
    public static function triCommentairesSelonNiveau($listeCommentaires, $tableauTri = null, $niveau = 0, $index = 0)
    {
//        Je crée le tableau pour ce niveau
        $tableTriNouveau = array();

//        Pour chacun des commentaires
        for ($i = $index; $i < sizeof($listeCommentaires) ; $i++ ){

//            J'ajoute l'élément au tableau
            $tableTriNouveau[] = array($listeCommentaires[$i], $niveau);

            $id = $listeCommentaires[$i]->id();
            unset($listeCommentaires[$i]);
            foreach ($listeCommentaires as $commentaire){

                if ($id == $commentaire->responseTo()) {
                    return self::triCommentairesSelonNiveau($listeCommentaires, $tableTriNouveau, $niveau + 1, $i);
                }
            }

        }

//        Je retourne le tableau existant avec celui que je viens de créé
        if( $tableauTri == null ){
            return $tableTriNouveau;
        }

        return array_merge($tableauTri, $tableTriNouveau);
    }

}
