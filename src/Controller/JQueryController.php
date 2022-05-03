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

    #[Route('/effects', name: 'JQueryEffects')]
    public function effectsJquery(): Response
    {
        return $this->render('JQueryDemo/effects.html.twig',[]);
    }
    #[Route('/animate', name: 'JQueryAnimate')]
    public function animateJquery(): Response
    {
        return $this->render('JQueryDemo/callback&chaining.html.twig',[]);
    }
    #[Route('/dom', name: 'JQueryDom')]
    public function domJquery(): Response
    {
        return $this->render('JQueryDemo/dom.html.twig',[]);
    }   
}
