<?php


namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class VisiteurController extends AbstractController
{
    /**
     * @Route("/user/all", name="alluser")
     * @param SessionInterface $session
     * @return Response
     */
    public function all(SessionInterface $session){
        $users = $this->getDoctrine()->getRepository(Users::class)->findAll();
        return $this->render('Dashboard/User/all.html.twig',array(
            'users' => $users,
            'user' => $session->get('user',[])[0]
        ));
    }
}