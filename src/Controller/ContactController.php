<?php

namespace App\Controller;

use App\Entity\ContactInformation;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $contact_informations = $form->getData();
            $entityManager->persist($contact_informations);
            $entityManager->flush();
            return $this->render('contact/summary.html.twig');
        }else{
        return $this->render('contact/index.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }

    }
}
