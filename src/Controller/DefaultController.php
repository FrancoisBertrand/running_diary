<?php
/**
 * Created by IntelliJ IDEA.
 * User: burak
 * Date: 12/20/17
 * Time: 12:04 AM
 */
namespace App\Controller;
use App\Repository\RunDiaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller {

    /*public function index(EntityManagerInterface $doctrine) {
        //return ['users' => $doctrine->getRepository('App:User')->findAll()];
    }*/

    /**
     * @Route("/", name="start")
     * @Template("base.html.twig")
     */
    public function index(){

    }

}