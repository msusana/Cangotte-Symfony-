<?php

namespace App\Controller;

use App\Entity\Campagne;
use App\Entity\Participant;
use App\Entity\Payment;
use App\Form\CampagneType;
use App\Repository\CampagneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/campagne")
 */
class CampagneController extends AbstractController
{
    /**
     * @Route("/", name="campagne_index", methods={"GET"})
     */
    public function index(CampagneRepository $campagneRepository): Response
    {
        return $this->render('campagne/index.html.twig', [
            'campagnes' => $campagneRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="campagne_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    { 
        $data = $request->get('name') ;

        $campagne = new Campagne();
        $form = $this->createForm(CampagneType::class, $campagne);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($campagne);
            $entityManager->flush();
            
            return $this->redirectToRoute('campagne_index');
        }
       
        return $this->render('campagne/new.html.twig', [
            'campagne' => $campagne,
            'form' => $form->createView(),
            'inputValue' => $data,
        ]);
    }

    /**
     * @Route("/{id}", name="campagne_show", methods={"GET"})
     */
    public function show(Campagne $campagne): Response
    {

        //TODO recupérer les liste des participants et leur payement
        $participantsRepository = $this->getDoctrine()
                                        ->getRepository(Participant::class);
        $participants = $participantsRepository->findBy(['campagneId' =>$campagne->getId()]);

        $paymentRepository = $this->getDoctrine()
                                    ->getRepository(Payment::class);
        $payments = $paymentRepository->findBy(['participantId'=> $participants]);
        
        return $this->render('campagne/show.html.twig', [
            'campagne' => $campagne,
            'payments' => $payments,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="campagne_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Campagne $campagne): Response
    {
        $form = $this->createForm(CampagneType::class, $campagne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('campagne_index');
        }

        return $this->render('campagne/edit.html.twig', [
            'campagne' => $campagne,
            'form' => $form->createView(),
            'inputValue' => '',
        ]);
    }

    /**
     * @Route("/{id}", name="campagne_delete", methods={"POST"})
     */
    public function delete(Request $request, Campagne $campagne): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campagne->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($campagne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('campagne_index');
    }
}
