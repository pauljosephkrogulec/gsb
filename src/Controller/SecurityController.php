<?php


namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{


    /**
     * @Route ("/",name="Login")
     * @param null $mail
     * @return Response
     */
    public function HomeLogin($mail = null){
        return $this->render('security/login.html.twig',  array(
            'last_username' => $mail,
            'error'         => '',
        ));
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }

    /**
     * @Route ("/login",name="log-in")
     * @return Response
     */
    public function login()
    {
        $psd = hash('sha512',$_POST['password']);
        $rep = $this->getDoctrine()->getRepository(Users::class)->Login($_POST['email'],$psd);
        if($rep==NULL){
            return $this->HomeLogin($_POST['email']);
        }else{
            $_SESSION['user'] = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['email' => $_POST['email']]);
            return $this->redirectToRoute('HomePage');
        }

    }

    /**
     * @Route ("/forgotPassword", name="forgetPassword")
     * @return Response
     */
    public function HomeForgetPassword(){

        return $this->render('security/forgetPassword.html.twig');
    }

}