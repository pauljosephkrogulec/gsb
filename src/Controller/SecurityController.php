<?php


namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
            return $this->HomeLogin($_POST['email']);
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

        $token = md5(uniqid(rand(), true));
        $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 25))
            ->setUsername('d6ccf96511da7a')
            ->setPassword('74af373be7100d')
        ;
        $mailer = new Swift_Mailer($transport);
        $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['id' => $id]);
        $token = md5(uniqid(rand(), true));
        $user->setToken($token);
        $this->em->persist($user);
        $this->em->flush();

        $message = (new Swift_Message('Password'))
            ->setFrom('no-reply@krogulec.xyz')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'email/password-reset.html.twig',
                    ['user' => $user, 'token' => $token]
                ),
                'text/html'
            );
        $mailer->send($message);
        return $this->redirectToRoute('HomePage');
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
            return $this->redirectToRoute("HomePage");
        }

    }

    /**
     * @Route ("/resetPassword{token}", name="resetPassword")
     * @param $token
     * @return RedirectResponse|Response
     */
    public function resetPassword($token){
        $rep = $this->getDoctrine()->getRepository(Users::class)->findToken($token);
        if($rep==NULL){
            return $this->redirectToRoute('Login');
        }
        return $this->render('security/changePassword.html.twig', ['token' => $token]);
    }

    /**
     * @Route ("/changePassword{token}  ", name="changePassword")
     * @param $token
     */
    public function changePassword($token){
        $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['token' => $token]);
        if($user == NULL){
            return $this->redirectToRoute('Login');
        }
        else{
            $psd = hash('sha512',$_POST['password']);
            $user->setPassword($psd);
            $this->em->persist($user);
            $this->em->flush();
            return $this->HomeLogin($user->getEmail());
        }
    }
}