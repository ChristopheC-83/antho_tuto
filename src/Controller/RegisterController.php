<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $em,UserPasswordHasherInterface $passwordHashed): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // dd($passwordHashed->hashPassword($user,$form->getData()->getPassword()));
            $user->setPassword($passwordHashed->hashPassword($user, $form->getData()->getPassword()));

            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Votre compte a bien été créé ! Vous pouvez vous connecter.');
            return $this->redirectToRoute('app_login');
        } else {
            $this->addFlash('alert', 'Echec de la création de votre compte.');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
