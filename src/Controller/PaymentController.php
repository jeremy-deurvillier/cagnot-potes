<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\Participant;
use App\Entity\Payment;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/campaign/{id}/payment', name: 'app_campaign_payment')]
    public function payment(Request $request, Campaign $campaign, EntityManagerInterface $entityManager): Response
    {
        $participant = new Participant();
        $payment = new Payment();
        //$form = $this->createForm(PaymentType::class);
        $form = $this->createFormBuilder()
            ->add('name')
            ->add('email')
            ->add('amount')
            ->getForm()
        ;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $participant->setName($form->getViewData()['name']);
            $participant->setEmail($form->getViewData()['email']);
            $participant->setCampaign($campaign);
            
            $payment->setAmount($form->getViewData()['amount']);
            $payment->setCreatedAt(new DateTimeImmutable());
            $payment->setUpdatedAt(new DateTimeImmutable());
            $payment->getParticipant($participant);

            $participant->addPayment($payment);
            // dd($participant);
            $entityManager->persist($participant);
            $entityManager->persist($payment);
            $entityManager->flush();

            return $this->redirectToRoute('app_campaign_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('campaign/payment.html.twig', [
            'campaign' => $campaign,
            'form' => $form,
        ]);
    }
}
