<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Video;
use App\Entity\Trick;
use App\Entity\Comment;

use App\Form\TrickType;
use App\Form\CommentType;


use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrickController extends AbstractController
{

    

    /**
     * @Route("/", name="app_home", methods={"GET"})
     */
    public function index(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findBy([], ['createdAt'=>'DESC']);
        dump($tricks);
        return $this->render('tricks/index.html.twig', ['tricks'=>$tricks]);
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
            //recup les images depuis le formulaire
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
                dump($video);

                //Enregister dans la bdd
                //$trick->addVideo($video);
                $model1->setEmbedded($video); //$form->get('videos')->getData()   trick->addVideo($video)     ->setEmbedded($video);

            }

            $em->persist($trick);
            $em->flush();

            $this->addFlash('success', 'Trick successfully edited');
            return $this->redirectToRoute('app_home');
        }

        
        return $this->renderForm('tricks/create.html.twig', ['form'=> $form,]);
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
        }

        return $this->renderForm('tricks/show.html.twig', ['trick'=>$trick,'form'=>$form]);
    }

    // @Security("is_granted('TRICK_DELETE', trick)")
    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route("/tricks/{slug}/edit", name="app_tricks_edit", methods={"GET", "PUT"})
     */
    public function edit(Request $request, EntityManagerInterface $em, Trick $trick): Response
    {
        $form = $this->createForm(TrickType::class, $trick, ['method'=> 'PUT']);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $images = $form->get('images')->getData();
            foreach ($images as $image) {
                $fichier = md5(uniqid().'.'.$image->guessExtension());
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                //on stock l'image ds la bdd. 
                $img = new Photo();
                $img->setName($fichier);
                $img->setTrick($trick);
                $trick->addPhoto($img);

            }
                $em->persist($trick);
                $em->flush();
        }

        return $this->renderForm('tricks/edit.html.twig',['form'=>$form, 'trick'=>$trick]);
    }

    // @Security("is_granted('TRICK_DELETE', trick)")
    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route("/tricks/{slug}/delete", name ="app_tricks_delete", methods={"DELETE"})
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

    //Limiter un commentaire par user
    /**
     * @Route("/comments/create", name="app_comment_create", methods={"GET","POST"})
     */
    public function commentCreate(Trick $trick): Response
    {
        $comment = new Comment();
        $trick->addComment($comment);
        return $this->redirectToRoute('app_home');
    }

    /**
     * @Route("/delete/photo/{id}", name="app_delete_photo", methods={"DELETE"})
     */
    public function deletePhoto(Photo $photo, Request $request, EntityManagerInterface $em): JsonResponse
    {
        //json_decode — Décode une chaîne JSON
        $data = json_decode($request->getContent(), true);
        dump($data);

        //Attention: $photo->getId()  risque de securite injection utilisateur.
        //Quel photo supprimer 
        if($this->isCsrfTokenValid('delete'.$photo->getId(), $data['_token']))
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
