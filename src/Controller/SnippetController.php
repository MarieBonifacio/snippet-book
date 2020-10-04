<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Snippet;
use App\Form\SnippetFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class SnippetController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/snippet", name="snippet")
     */
    public function index()
    {
        return $this->render('snippet/index.html.twig', [
            'controller_name' => 'snippetController',
        ]);
    }


    /**
     * @Route("/snippet/new", name="snippet_new", methods={"GET"})
     */
    public function addSnippet()
    {
        $snippet = new Snippet();
        $form = $this->createForm(SnippetFormType::class, $snippet);

        return $this->render('snippet/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/snippet/new", name="snippet_save", methods={"POST"})
     */
    public function saveSnippet(Request $request)
    {
        $snippet = new Snippet();
        $form = $this->createForm(SnippetFormType::class, $snippet);
        //Recupère infos du form
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $snippet = $form->getData();
            $this->entityManager->persist($snippet);
            $this->entityManager->flush();
            $this->addFlash('success', 'snippet created!');
        }
        return $this->redirectToRoute('snippet_new');
    }
}

