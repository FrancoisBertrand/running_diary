<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 01.01.18
 * Time: 19:42
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller{

    /**
     * @Route("Profil/userProfil", name="userProfil")
     */
    public function userData(){

        /**
         * TODO hier muessen noch userdaten geladen werden aehnlich wie bei road runner nur nicht aus localStor sondern aus DB
         */

        $log = false;
        /**
         * abfrage ob benutzer eingeloggt ist
         */
        if($log == true){
           return $this->render('Profil/profilUser.html.twig', array(

           ));
        }
        else{
            return $this->render('Profil/profilAnon.html.twig', array(

            ));
        }
    }
}