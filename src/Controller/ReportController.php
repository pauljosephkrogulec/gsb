<?php


namespace App\Controller;

use App\Entity\ExpenseReports;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    /**
     * @Route("/report/all", name="allreport")
     * @param SessionInterface $session
     * @return Response
     */
    public function all(SessionInterface $session){
        $expense = $this->getDoctrine()->getRepository(ExpenseReports::class)->findAll();
        return $this->render('Dashboard/Doctor/all.html.twig',array(
            'users' => $expense,
            'user' => $session->get('user',[])[0]
        ));
    }
}