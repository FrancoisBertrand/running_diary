<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 01.01.18
 * Time: 17:59
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\UserData;

class OverViewController extends Controller{

    /**
     * @Route("/{name}", name="userList", defaults={"name"=null})
     */
    public function overView(){

        /**
         * TODO daten aus der DB fuer die Tabelle holen
         */
        $users = $this->getDoctrine()->getRepository(UserData::class);
        $user1 = $users->findBy(['username' => 'Peter']);


        return $this->render('OverView/overview.html.twig', array(

        ));
    }
}