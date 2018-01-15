<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 11.01.18
 * Time: 15:03
 */

namespace App\Controller;


use App\Entity\UserData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\User;

class AutoSearchController extends Controller{

    /*
     * Aufgabe 7 Teil 1
     */

    /**
     * @Route("/search/{search}", methods={"GET"})
     */
    public function searchUser(Request $request, $search, EntityManagerInterface $entityManager){

        // array mit allen usernamen
        $allUsers = $entityManager->getRepository('App:UserData')->findAll();
        $search = preg_replace("/[^a-zA-Z0-9]+/", "", $search);
        $searchCounter = strlen($search);

        $findUsers = array();

        if($searchCounter >= 3){
            for($i = 0; $i < 10; $i++){
                if(!stristr($allUsers[$i]->username, $search)){

                }
                else{
                    $findUsers[$i] = $allUsers[$i];

                }
            }
        }

        if(empty($findUsers)){
            return $this->json("Leider keine Übereinstimmung gefunden.");
        }
        else{
            return $this->json($findUsers);
        }

    }
}