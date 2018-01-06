<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 01.01.18
 * Time: 17:59
 */

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Entity\UserData;

class OverViewController extends Controller
{

    /**
     * @Route("OverView/userList", name="userList", defaults={"name"=null})
     * @Template("OverView/overview.html.twig")
     */
    public function overView(EntityManagerInterface $entityManager)
    {

        return ['usernames' => $entityManager->getRepository('App:UserData')->findAll(),
            'diaries' => $entityManager->getRepository('App:RunDiary')->findAll()];
    }
}