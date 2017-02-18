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
    public static function triCommentairesSelonNiveau(&$listeCommentaires, &$tableauTri = array(), $niveau = 0, $responseTo = 0)
    {


//        Pour chacun des commentaires
        foreach ($listeCommentaires as $commentaire){

//          Si le commentaire commentaire n'est pas au premier niveau lors de du première appelle on passe
            if ($niveau == 0 && $commentaire->responseTo() > 0){
                continue;
            }


            //            Si c'est un commentaire de premier niveau ou si c'est un commentaire qui répond au commentaire que l'on cherche
            if ( ( $responseTo === 0 && $niveau == 0 ) || ( $responseTo > 0 && ($responseTo == $commentaire->responseTo()) ) ){
                //            Alors on ajoute
                array_push($tableauTri, array($commentaire, $niveau));
                $id = $commentaire->id();

                //            Si l'élément a été ajouté alors On supprime l'élément pour s'assurer qu'il ne réapparaitra plus
                unset($listeCommentaires[array_search($commentaire,$listeCommentaires)]);

                //            On retourne les sous commentaires
                if ($niveau < 2){
                    $tableauTri = self::triCommentairesSelonNiveau($listeCommentaires, $tableauTri, ($niveau + 1), $id);
                }
            }





        }

//        Je retourne le tableau
            return $tableauTri;

    }

}
