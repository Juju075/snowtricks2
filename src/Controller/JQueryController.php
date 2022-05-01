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
    #[Route('/event', name: 'JQueryEvent')]
    public function eventJquery(): Response
    {
        return $this->render('JQueryDemo/event1.html.twig',[]);
    }


}
