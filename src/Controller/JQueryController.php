<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JQueryController extends AbstractController
{
    #[Route('/jquery', name: 'JQuery')]
    public function index(): Response
    {
        return $this->render('JQueryDemo/JQ.html.twig',[]);
    }

    #[Route('/events', name: 'JQueryEvent')]
    public function eventsJquery(): Response
    {
        return $this->render('JQueryDemo/events.html.twig',[]);
    }

    #[Route('/effects', name: 'JQueryEvent')]
    public function effectsJquery(): Response
    {
        return $this->render('JQueryDemo/effects.html.twig',[]);
    }
}
