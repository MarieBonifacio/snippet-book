<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    /**
     * @Route("/snippets/{language}", name="default")
     */
    public function index(?string $name)
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'name' => $name,
        ]);
    }
}
