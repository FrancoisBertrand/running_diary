<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 01.01.18
 * Time: 19:42
 */

namespace App\Controller;

use App\Entity\RunDiary;
use App\Entity\UserData;
use App\Form\DiaryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ProfilController extends Controller{

    /**
     * @Route("Profil/{username}", name="userProfil")
     */
    public function userData(EntityManagerInterface $entityManager, UserData $userData, Request $request){

        /**
         * TODO hier muessen noch userdaten geladen werden aehnlich wie bei road runner nur nicht aus localStor sondern aus DB
         */
        $ownerPost = $entityManager->getRepository('App:RunDiary')->findBy(['owner' => $userData],['date' => 'DESC']);

        $signedUser = $this->get('security.token_storage')->getToken()->getUser();

        //var_dump($signedUser);
        $form = null;
        $toHighAvgSpeed = 0;
        $years = 0;
        $months = 0;
        $days = 0;

        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            if ($userData->getUsername() === $signedUser->username){
                $form = $this->createForm(DiaryType::class);
                $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){
                    $saveData = $form->getData();
                    $toHighAvgSpeed = $this->avgSpeed($saveData->duration, $saveData->distance);
                    //var_dump($toHighAvgSpeed);
                    if($toHighAvgSpeed <= 40){
                        $diary = new RunDiary();
                        $diary->setOwner($this->getUser());

                        $diary->setDate($saveData->date);
                        $diary->setDistance($saveData->distance);
                        $diary->setDuration($saveData->duration);

                        $diary->setAvgSpeed($toHighAvgSpeed);
                        $ownerPost = $this->getDoctrine()->getManager();
                        $ownerPost->persist($diary);
                        $ownerPost->flush();

                        // resettet das Formular
                        return $this->redirect($request->getUri());
                    }
                }
            }

            //var_dump($ownerPost);
            if(!empty($ownerPost)){
                $rundayDiff = abs(strtotime(date('Y-m-d'))) - strtotime($ownerPost[sizeof($ownerPost)-1]->date->format('Y-m-d H:i:s'));

                //umwandlung in sekunden
                $years = floor($rundayDiff / (365*60*60*24));
                $months = floor(($rundayDiff - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($rundayDiff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            }
        }


        return $this->render('Profil/profilUser.html.twig', [
           'user' => $userData,
           'posts' => $ownerPost,
            'form' => is_null($form) ? null : $form->createView(),
            'rundayDiif' => ($years === 0 and $months === 0 and $days === 0) ?
                array('years' => 0, 'months' => 0, 'days' => 0) :
                array('years' => $years, 'months' => $months, 'days' => $days),
            'avgSpeed' => array("overForty" => ($toHighAvgSpeed>40) ? true : false, "output" => $toHighAvgSpeed),
        ]);
    }

    public function avgSpeed($time, $distance){
        $hours =0;
        $seconds = 0;
        $minutes = 0;
        sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);

        $time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
        $speed = $distance / $time_seconds;
        return round(($speed * 3600),2);
    }

    /**
     * @Route("/Profil/diary/{id}", name="delete")
     * @param RunDiary $diary
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(RunDiary $diary, EntityManagerInterface $entityManager, Request $request){
        //var_dump($diary);
        $this->denyAccessUnlessGranted('delete', $diary, 'Du darfst das nicht löschen!');
        $entityManager->remove($diary);
        $entityManager->flush();

        return $this->redirectToRoute('userProfil', array('username' => $diary->getOwner()->getUsername()));
    }
}