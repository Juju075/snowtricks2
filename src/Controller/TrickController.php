<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TrickRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TrickController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods={"GET"})
     */
    public function index(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findBy([], ['createdAt'=>'DESC']);
        return $this->render('tricks/index.html.twig', compact('tricks'));
    }

    
    /**
     * @Route("/tricks/create",name="app_tricks_create", methods={"GET","POST"})
     */
    public function create(Request $request, EntityManagerInterface $em): Response 
    {
        $trick = new Trick;
        $form = $this->createform(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($trick);
            $em->flush();

            $this->addFlash('success', 'Trick successfully edited');
            return $this->redirectToRoute('app_home');
        }
        return $this->renderForm('tricks/create.html.twig', ['form'=> $form,]);
    }

    /**
    * @Route("/tricks/{id<[0-9]+>}", name="app_tricks_show", methods={"GET"})
    */
    public function show(Trick $trick):Response
    {
        return $this->render('tricks/show.html.twig', compact('trick'));
    }


    //Zakaria 
    /**
    * 
     */
    public function showZakaria(int $id): Response
    {
        $trick = $this->getDoctrine()->getRepository(Trick::class)->find($id);
        return $this->render('tricks/show.html.twig', ['trick'=>$trick]);
    }

    /**
     * @Route("/tricks/{id<[0-9]+>}/edit", name="app_tricks_edit", methods={"GET","PUT"})
     */
    public function edit(Request $request, EntityManagerInterface $em, Trick $trick): Response
    {
        //prepopuler les champs
        $form = $this->createForm(TrickType::class, $trick, ['method'=> 'PUT']);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
                $em->persist($trick);
                $em->flush();
        }
        return $this->renderForm('tricks/edit.html.twig',['form'=>$form]);
    }
    /**
     * @Route("/tricks/{id<[0-9]+>}/delete", name = "app_tricks_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EntityManagerInterface $em, Trick $trick): Response
    {
        //Contraite etre l'auteur(token) du $trick.
        if ($this->isCsrfTokenValid('trick_deletion_' . $trick->getId(), $request->request->get('csrf_token'))) {
            $em->remove($trick);
            $em->flush();
            $this->addFlash('info', 'Trick successfully deleted!');
        }
        return $this->redirectToRoute('app_home');
    }
}
