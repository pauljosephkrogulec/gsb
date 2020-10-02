<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController{


    /**
     * @Route ("/Dashboard", name="DashBoard")
     */
    public function Home(SessionInterface $request)
    {
        $user = $request->get('user', []);
        if($user == array()){
            return $this->redirectToRoute('Login');
        }
        return $this->render("Dashboard/Dashboard.html.twig", array('user' => $user[0]));
    }
}