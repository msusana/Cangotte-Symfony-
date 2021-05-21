<?php

namespace App\Controller;
use App\Entity\Campagne;
use App\Entity\Participant;
use App\Entity\Payment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CampagneRepository;
use App\Repository\ParticipantRepository;
use App\Repository\PaymentRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CampagneRepository $campagneRepository, PaymentRepository $paymentRepository, ParticipantRepository $participantRepository): Response
    {
        $campagnes =  $campagneRepository->findBy([], [], 5 , 0);
        $participants = $participantRepository->findBy(['campagneId' =>$campagnes]);

        $payments = $paymentRepository->findBy(['participantId'=> $participants]);
        
        return $this->render('home/index.html.twig', [
            'campagnes' => $campagnes,
            'payments'=> $payments,
            'participants' => $participants
        ]);
    }
   
}
