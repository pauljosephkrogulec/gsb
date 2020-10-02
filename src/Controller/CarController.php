<?php


namespace App\Controller;


use App\Entity\Vehicles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @Route("/car/all", name="allcar")
     * @param SessionInterface $session
     * @return Response
     */
    public function all(SessionInterface $session){
        $car = $this->getDoctrine()->getRepository(Vehicles::class)->findAll();
        return $this->render('Dashboard/Car/all.html.twig',array(
            'users' => $car,
            'user' => $session->get('user',[])[0]
        ));
    }
}