<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 18.01.18
 * Time: 14:06
 */

namespace App\Controller;

use App\Repository\RunDiaryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\AcceptHeader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;


class ChangeLanguageController extends Controller
{
    //TODO default sprache fuer die Session aendern
    /**
     * @Route("/", name="changeEn")
     * @Method("GET")
     */
    public function changeEn(Request $request){
        $locale = $request->getLocale();
        var_dump($locale);
        return $this->render('base.html.twig');
    }


    /**
     * @Route("/", name="changeDe")
     * @Method("GET")
     */
    public function changeDe(Request $request){
        $locale = $request->getLocale();
        var_dump($locale);
        return $this->render('base.html.twig');
    }
}