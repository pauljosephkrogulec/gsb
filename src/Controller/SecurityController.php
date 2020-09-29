<?php


namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
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
        $transport = new EsmtpTransport('localhost');
        $mailer = new Mailer($transport);
        $user = $this->getDoctrine()->getRepository(Users::class)->find($id);
        $mail = $user->getEmail();
        $chaine = md5(uniqid());
        var_dump($user);

        $this->em->persist($user);
        $this->em->flush();
        if ($user) {
            $message = (new Email())
                ->from('no-reply@gsb.krogulec.xyz')
                ->to($mail)
                ->subject ('Password')
                ->html(
                    $this->renderView('email/password-reset.html.twig',
                        ['user' => $user, 'token' => $chaine]), 'text/html'
            );
            $mailer->send($message);
        }

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