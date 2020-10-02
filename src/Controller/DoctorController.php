<?php


namespace App\Controller;

use App\Entity\Doctor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DoctorController extends AbstractController
{
    /**
     * @Route("/doctor/all", name="alldoctor")
     * @param SessionInterface $session
     * @return Response
     */
    public function all(SessionInterface $session){
        $doctor = $this->getDoctrine()->getRepository(Doctor::class)->findAll();
        return $this->render('Dashboard/Doctor/all.html.twig',array(
            'users' => $doctor,
            'user' => $session->get('user',[])[0]
        ));
    }
}