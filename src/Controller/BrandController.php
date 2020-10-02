<?php


namespace App\Controller;


use App\Entity\Brands;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController
{
    /**
     * @Route("/brand/all", name="allbrands")
     * @param SessionInterface $session
     * @return Response
     */
    public function all(SessionInterface $session){
        $brands = $this->getDoctrine()->getRepository(Brands::class)->findAll();
        return $this->render('Dashboard/Brand/all.html.twig',array(
            'users' => $brands,
            'user' => $session->get('user',[])[0]
        ));
    }
}