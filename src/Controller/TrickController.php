<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Trick;
use App\Entity\Video;
use App\Entity\Comment;

use App\Form\TrickType;
use App\Form\CommentType;


use App\Repository\UserRepository;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{

    public $users;
    public $tricks;


    /**
     * @Route("/", name="app_home", methods={"GET"})
     */
    public function index(TrickRepository $trickRepository, Request $request): Response
    {
        // ===========================================================================
        // envoyer une requete ajax ?page=2 ect... et recuperer une réponse à afficher ($tricks).
        //A afficher dans la vue   eg:?page=3  requete querybuilder contenant l'item de debut selon calcul de page.
        // ===========================================================================
        $limit = 15;

        //[ Récuperation du querystring. ]
        $page = (int)$request->query->get("page", 1);  // url../?page=  int 1,2 , 3 ect

        // [ Les interogations de la Bdd. ]
        $tricks = $trickRepository->getPaginatedTricks($page, $limit);
        $total = $trickRepository->getTotalTricks();

        //Partie foreach
        if($request->isXmlHttpRequest()) { 
            return $this->render('tricks/_list_trick.html.twig', ['tricks'=>$tricks]);;
        }


        return $this->render('tricks/index.html.twig', ['tricks'=>$tricks, 'total'=>$total, 'limit'=>$limit, 'page'=>$page]);
    }


    /**
     * To create Trick
     * @Security("is_granted('ROLE_USER')")
     * @Route("/tricks/create",name="app_tricks_create", methods={"GET","POST"})
     * 
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */ 
    public function create(Request $request, EntityManagerInterface $em, TrickRepository $trickRepository): Response 
    {
        $trick = new Trick;
        // nullable multi images et/ou videos.
        $form = $this->createform(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $images = $form->get('photos');
            $videos = $form->get('videos');

            $trick->setUser($this->getUser());

            foreach ($images as $image) {
                $model = $image->getData(); 
                $image  = $image->get('name')->getData();
  
                if ($image instanceof UploadedFile) {
                    $fichier = md5(uniqid()).'.'.$image->guessExtension();
                    $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                 );
                    $model->setName($fichier); 
                }
            }

            $em->persist($trick);
            $em->flush();

            $this->addFlash('success', 'Trick successfully edited');
            return $this->redirectToRoute('app_home');
        }

        
        return $this->renderForm('tricks/create.html.twig', ['form'=> $form,]);
    }

    /**
    * @Route("/tricks/{slug}", name="app_tricks_show", methods={"GET","POST"})
    */
    public function show(Request $request, Trick $trick, EntityManagerInterface $em):Response
    {
        if (!$trick) {
            throw $this->createNotFoundException('Le trick n\'existe pas');
        }

        $comment = new Comment;
        $form = $this->createform(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {

            $comment->setUser($trick->getUser());
            $trick->addComment($comment);
            
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('app_tricks_show', ['slug'=>$trick->getSlug()]);
        }

        return $this->renderForm('tricks/show.html.twig', ['trick'=>$trick,'form'=>$form]);
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route("/tricks/{slug}/edit", name="app_tricks_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EntityManagerInterface $em, Trick $trick): Response
    {
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $images = $form->get('photos');

            foreach ($images as $image) {
                $model = $image->getData(); 
                $image = $image->get('name')->getData();
  
                if ($image instanceof UploadedFile) {
                    $fichier = md5(uniqid()).'.'.$image->guessExtension();
                    $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                 );
                    $model->setName($fichier); 
                }
            }
//video automatique via le collectionType 
            $em->persist($trick);
            $em->flush();
            $this->addFlash('success', 'Trick successfully edited!');
            return $this->redirectToRoute('app_tricks_show',['slug'=>$trick->getSlug()]);
        }
        return $this->renderForm('tricks/edit.html.twig',['form'=>$form, 'trick'=>$trick]);
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route("/tricks/{slug}/delete", name ="app_tricks_delete")
     */
    public function delete(Request $request, EntityManagerInterface $em, Trick $trick): Response
    { 
        $token = $request->request->get('csrf_token');
        $espected = 'trick_deletion_' . $trick->getId(); // reponse: trick_deletion_12

        if ($this->isCsrfTokenValid('trick_deletion_' . $trick->getId(), $request->request->get('_token'))) {
            $em->remove($trick);
            $em->flush();
            $this->addFlash('info', 'Trick successfully deleted!');
        }
        return $this->redirectToRoute('app_home');
    }

    /**
     * @Route("/comments/create", name="app_comment_creèate", methods={"GET","POST"})
     */
    public function commentCreate(Trick $trick): Response
    {
        $comment = new Comment();
        $trick->addComment($comment);
        return $this->redirectToRoute('app_home');
    }

}
