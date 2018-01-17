<?php
/**
 * Created by IntelliJ IDEA.
 * User: francoisbertrand
 * Date: 16.01.18
 * Time: 23:45
 */

namespace App\Controller;

use App\Entity\RunDiary;
use App\Entity\UserData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormView;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\DateTime;


class ExportController extends Controller{

    /**
     * @Route("/runners/{username}.{_format}", defaults={"_format":"json"}, name="runners")
     * @Method("GET")
     */
    public function exportJSON(UserData $user, Request $request)
    {
        $results = $this->getDoctrine()
            ->getRepository(RunDiary::class)->findBy(['owner' => $user], ['date' => 'DESC']);

        $response = new Response();
        $response->setContent(json_encode($results));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * @Route("/runner/{username}.{_format}", defaults={"_format"="csv"}, name="runner")
     * @Method("GET")
     */
    public function exportCSV(UserData $user, Request $request)
    {
        $resultsCSV = $this->getDoctrine()
            ->getRepository(RunDiary::class)->findBy(['owner' => $user], ['date' => 'DESC']);

        $responseCSV = new StreamedResponse();
        $responseCSV->setCallback(
            function () use ($resultsCSV) {
                $handle = fopen('php://output', 'r+');
                fputcsv($handle, array('User', 'strecke', 'dauer', 'durchschnitt'),';');
                foreach ($resultsCSV as $row) {
                    $data = array(
                        $row->getOwner()->username,
                        $row->getDistance(),
                        $row->getDuration(),
                        $row->getAvgSpeed(),
                    );
                    fputcsv($handle, $data);
                }
                fclose($handle);
            }
        );
        $responseCSV->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $user->getUsername().'.csv'));
        if (!$responseCSV->headers->has('Content-Type')) {
            $responseCSV->headers->set('Content-Type', 'text/csv"');
        }

        return $responseCSV;
    }

}