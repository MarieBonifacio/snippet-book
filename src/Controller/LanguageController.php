<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Language;
use App\Form\LanguageFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class LanguageController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/language", name="language")
     */
    public function index()
    {
        return $this->render('language/index.html.twig', [
            'controller_name' => 'languageController',
        ]);
    }


    /**
     * @Route("/language/new", name="language_new", methods={"GET"})
     */
    public function addLanguage()
    {
        $language = new Language();
        $form = $this->createForm(LanguageFormType::class, $language);

        return $this->render('language/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/language/new", name="language_save", methods={"POST"})
     */
    public function saveLanguage(Request $request)
    {
        $language = new Language();
        $form = $this->createForm(LanguageFormType::class, $language);
        //Recupère infos du form
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $language = $form->getData();
            $this->entityManager->persist($language);
            $this->entityManager->flush();
            $this->addFlash('success', 'language created!');
        }
        return $this->redirectToRoute('language_new');
    }
}

