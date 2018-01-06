<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 03.01.18
 * Time: 17:16
 */

namespace App\Controller;

use App\Repository\RunDiaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $utils){
        return $this->render('Login/login.html.twig', [
            'last_username' => $utils->getLastUsername(),
            'error' => $utils->getLastAuthenticationError(),
        ]);
    }


    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){
        throw  new \Exception('Unsichtbar');
    }
}