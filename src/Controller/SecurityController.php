<?php


namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route ("/",name="Login")
     * @param null $mail
     * @return Response
     */
    public function HomeLogin($mail = null){
        if($_GET!=array()){
            $mail='ee';
        }
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
        var_dump($rep);
        $_SESSION['id'] = $rep['id'];
        $_SESSION['email'] = $rep['email'];
        if($rep==NULL){
            return $this->redirectToRoute('Login',array());
        }else{
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
    public function sendMail($id)
    {
        $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 25))
            ->setUsername('d6ccf96511da7a')
            ->setPassword('74af373be7100d')
        ;
        $mailer = new Swift_Mailer($transport);
        $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['id' => $id]);
        $message = (new Swift_Message('Password'))
            ->setFrom('no-reply@krogulec.xyz')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'email/password-reset.html.twig',
                    ['user' => $user]
                ),
                'text/html'
            );
        $mailer->send($message);
        return $this->redirectToRoute('Login');
    }
    /**
     * @Route ("/sendingMail", name="mailing")
     */

    public function mailing(){
        $rep = $this->getDoctrine()->getRepository(Users::class)->findMail($_POST['email']);
        if($rep==NULL){
            return $this->redirectToRoute('forgetPassword');
        }
        else{

            $this->sendMail($rep['id']);
            return $this->render('Home/Home.html.twig');
        }

    }
}