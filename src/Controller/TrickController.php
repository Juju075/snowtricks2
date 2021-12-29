<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Photo;
use App\Entity\Video;
use App\Entity\Comment;

use App\Form\TrickType;
use App\Form\CommentType;


use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods={"GET"})
     */
    public function index(TrickRepository $trickRepository, Request $request): Response
    {
        $limit = 15;
        $page = (int)$request->query->get("page", 1);  // url../?page=
        $tricks = $trickRepository->getPaginatedTricks($page, $limit); //redefini $tricks
        $total = $trickRepository->getTotalTricks();

        return $this->render('tricks/index.html.twig', ['tricks'=>$tricks, 'total'=>$total, 'limit'=>$limit, 'page'=>$page]);
    }

    public function configureFields(string $pageName): iterable
    {
        $imageFile = null;
        $image = null;
        $fields = [];

       if (null) {
           # code...
       }else{

       } 
       return $fields;
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route("/tricks/create",name="app_tricks_create", methods={"GET","POST"})
     */
    public function create(Request $request, EntityManagerInterface $em): Response 
    {
        $trick = new Trick;
        // nullable multi images et/ou videos.
        $form = $this->createform(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $images = $form->get('photos');
            $videos = $form->get('videos');

            //Foreign key set: Recupere l'utilisateur via le token storage.
            $trick->setUser($this->getUser());

            foreach ($images as $image) {
                $model = $image->getData();  // $form->get('photos')->getData();   a la place de $img = new Images()
                $image  = $image->get('name')->getData();

                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                //on stock l'image ds la bdd. 
                $model->setName($fichier); 
                // $form->get('photos')->getData()  |   trick->add(photos)     |     ->setName($fichier)
                //ca vient de TrickType  by_reference add() pas set() il sait aussi que c dans PhotoType::class ('videos')
                //donc vas rechercher add(Photo $photo)
            }

            foreach($videos as $video){
                $model1 = $video->getData();
                $video = $video->get('embedded')->getData(); // erreur php Child "embedded" does not exist.
                $model1->setEmbedded($video); //$form->get('videos')->getData()   trick->addVideo($video)     ->setEmbedded($video);

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

            // Fullname et avatar (user) Pas de dupli de message
            //verif si dejat content identique Repository comment
            // if(findOneBy(content) === null){$trick->addComment($comment); alert 'This comment already exit'}
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
            $videos = $form->get('videos');

            foreach ($images as $image) {
                $model = $image->getData();  // $form->get('photos')->getData();   a la place de $img = new Images() 
                $image  = $image->get('name')->getData();

                //si l'image est une instance de     
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

    //Limiter un commentaire par user
    /**
     * @Route("/comments/create", name="app_comment_creèate", methods={"GET","POST"})
     */
    public function commentCreate(Trick $trick): Response
    {
        $comment = new Comment();
        $trick->addComment($comment);
        return $this->redirectToRoute('app_home');
    }

    // =============================================================================
    // DELETE PHOTO ET VIDEO
    // =============================================================================

    /**
     * @Route("/delete/photo/{id}", name="app_delete_photo")
     */
    public function deletePhoto(Photo $photo, Request $request, EntityManagerInterface $em): JsonResponse
    {
        //json_decode — Décode une chaîne JSON
        $data = json_decode($request->getContent(), true);

        //Attention: $photo->getId()  risque de securite injection utilisateur.
        //Quel photo supprimer 
        if($this->isCsrfTokenValid('delete_'.$photo->getId(), $data['_token']))
        {
            //pour la supprimer physiquement le fichier sur le disk.
            $nom = $photo->getName();
            unlink($this->getParameter('image_directory').'/'.$nom);

            $em->remove($photo);
            $em->flush();

            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error'=>'Token Invalide'], 400);
        }
    }

    

    /**
     * @Route("/delete/photo/{id}", name="app_delete_photo", methods={"DELETE"})
     */
    public function deleteVideo(Video $video, Request $request, EntityManagerInterface $em): JsonResponse
    {
        //Ajax
        $data = json_decode($request->getContent(), true);

        //Attention: $photo->getId()  risque de securite injection utilisateur.
        //Quel photo supprimer 
        if($this->isCsrfTokenValid('delete'.$video->getId(), $data['_token']))
        {
            $em->remove($video);
            $em->flush();
            //alert green photo supprimer
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error'=>'Token Invalide'], 400);
        }
    }
}

 
