<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{


    /**
     * @Route ("/Home", name="HomePage")
     */
    public function Home()
    {
        session_start();

        return $this->render("Home/Home.html.twig");
    }
}