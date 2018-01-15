<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 13.01.18
 * Time: 19:26
 */

namespace App\Controller;


use App\Entity\UserData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\NotBlank;

class PostSearchController extends Controller{


    /**
    * @Route("/searchUser", name="searchUser")
    * @Method("POST")
    */
    public function searchUser(Request $request, EntityManagerInterface $entityManager){

        $users = $entityManager->getRepository('App:UserData')->findAll();
        $suche = $request->get('suche');


        // TODO: Userabfrage, ob er existiert



        return $this->redirectToRoute('userProfil', array('username' => $suche));
    }

}