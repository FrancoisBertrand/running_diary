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

    // Aufgabe 7 Teil 2 ohne AJAX

    /**
    * @Route("/searchUser", name="searchUser")
    * @Method("POST")
    */
    public function searchUser(Request $request, EntityManagerInterface $entityManager){

        $users = $entityManager->getRepository('App:UserData')->findAll();
        $suche = $request->get('suche');
        if(empty($suche)){
           throw $this->createNotFoundException("Suchanfrage darf nicht Leer sein!");
        }
        else{
            for($i = 0; $i < count($users); $i++){
                if($users[$i]->username === $suche){
                    return $this->redirectToRoute('userProfil', array('username' => $suche));
                }
            }
            throw $this->createNotFoundException("Der Läufer wurde nicht gefunden");
        }
    }
}