<?php


namespace App\Controller;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{


    /**
     * @Route ("/Home", name="HomePage")
     */
    public function Home(SessionInterface $request)
    {
        $user = $request->get('user', []);
        if($user == array()){
            return $this->redirectToRoute('Login');
        }
        return $this->render("Home/Home.html.twig");
    }
}