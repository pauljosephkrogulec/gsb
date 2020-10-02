<?php


namespace App\Controller;

use App\Entity\DoctorOffice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DoctorOfficeController extends AbstractController
{
    /**
     * @Route("/office/all", name="alloffice")
     * @param SessionInterface $session
     * @return Response
     */
    public function all(SessionInterface $session){
        $office = $this->getDoctrine()->getRepository(DoctorOffice::class)->findAll();
        return $this->render('Dashboard/DoctorOffice/all.html.twig',array(
            'users' => $office,
            'user' => $session->get('user',[])[0]
        ));
    }
}