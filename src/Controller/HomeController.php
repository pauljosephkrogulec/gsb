<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    /**
     * @Route ("/Home", name="HomePage")
     */
    public function Home()
    {
        return $this->render("Home/Home.html.twig");
    }
}