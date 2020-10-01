<?php


namespace App\Controller;

use App\Entity\Users;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use function Sodium\add;

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
    public function logout(SessionInterface $request)
    {
        $user = $request->get('user',[]);
        unset($user[0]);
        $request->set('user',$user);
        return $this->redirectToRoute('HomePage');
    }

    /**
     * @Route ("/login",name="log-in")
     * @return Response
     */
    public function login(Request $request)
    {
        $psd = hash('sha512',$_POST['password']);
        $rep = $this->getDoctrine()->getRepository(Users::class)->Login($_POST['email'],$psd);
        if($rep==NULL){
            return $this->HomeLogin($_POST['email']);
        }else{
            $session = $request->getSession();
            $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['email' => $_POST['email']]);
            $users = $session->get('user',[]);
            $users[0] = $user;
            $session->set('user',$users);
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