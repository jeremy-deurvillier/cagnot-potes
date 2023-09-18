<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\Payment;
use App\Form\PaymentType;
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
        $payment = new Payment();
        $form = $this->createForm(PaymentType::class, $payment);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $payment->getParticipant()->setCampaign($campaign);
            
            $payment->setCreatedAt(new DateTimeImmutable());
            $payment->setUpdatedAt(new DateTimeImmutable());

            //dd($payment);
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
