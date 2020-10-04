<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tag;
use App\Form\TagFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class TagController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/tag", name="tag")
     */
    public function index()
    {
        return $this->render('tag/index.html.twig', [
            'controller_name' => 'TagController',
        ]);
    }


    /**
     * @Route("/tag/new", name="tag_new", methods={"GET"})
     */
    public function addTag()
    {
        $tag = new Tag();
        $form = $this->createForm(TagFormType::class, $tag);

        return $this->render('tag/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tag/new", name="tag_save", methods={"POST"})
     */
    public function saveTag(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm(TagFormType::class, $tag);
        //Recupère infos du form
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $tag = $form->getData();
            $this->entityManager->persist($tag);
            $this->entityManager->flush();
            $this->addFlash('success', 'Tag created!');
        }
        return $this->redirectToRoute('tag_new');
    }
}

