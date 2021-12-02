<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Trick;
use App\Entity\Comment;

use App\Form\TrickType;
use App\Form\CommentType;


use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
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
        return $this->render('tricks/index.html.twig', compact('tricks'));
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
            $images = $form->get('images')->getData();

            //Foreign key set: Recupere l'utilisateur via le token storage.
            $trick->setUser($this->getUser());

            // $img->setTrickId($fk); 

            //pour instancier Photo::class pour chaque image uploader.
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
                $trick->addPhoto($img); //[]de photos $this->photos[] = $photos;
                //Foreign key set: setTrick valeur id (mappedBy="trick")du trick
                //depuis l'entite du controlleur Trick fonction disponible.

                //$img et $trick (les entites en relation)
                //ou se trouve la fonction qu'on veut appeler pour setter
                //quel est la variable cible.
                //quel valeur on vas lui donner
                //quel est le getter qui vas le recuperer.
                //$this pour indiquer que celui encours.
                

                // dump trick_id pas encore persiste

                //$img->setTrick($trick->getId());
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
    * @Route("/tricks/{id<[0-9]+>}", name="app_tricks_show", methods={"GET","POST"})
    */
    public function show(Request $request, EntityManagerInterface $em, Trick $trick):Response
    {
        $comment = new Comment;
        $form = $this->createform(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $content = $form->get('content')->getData();
            $comment->setContent($content);
            //Le champ 'user_id' ne peut être vide
            $comment->setUser($trick->getUser());
            $comment->setTrick($trick);
            $em->persist($comment);
            $em->flush();
        }

        //Data pour la vue ou trick.photo 
        //Affichages de 3 photos et 3 videos
        //Affichages du listing des commentaires
        //getters de trick {{ trick.photo }}
        $photos = $trick->getPhoto();
        dump($photos);
        $videos = $trick->getVideo();
        $comments = $trick->getComments();
        $videos = null;

        return $this->renderForm('tricks/show.html.twig', ['trick'=>$trick, 'photos'=>$photos, 'videos'=>$videos, 'comments'=>$comments, 'form'=>$form]);
    }




    // @Security("is_granted('TRICK_DELETE', trick)")
    // methods={"GET","PUT"}
    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route("/tricks/{id<[0-9]+>}/edit", name="app_tricks_edit", methods={"GET","POST"})
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
     * @Route("/tricks/{id<[0-9]+>}/delete", name ="app_tricks_delete", methods={"DELETE"})
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
     * id de la photo
     * @Route("/delete/photo/{id}", name="app_delete_photo", methods={"DELETE"})
     */
    public function deletePhoto(Photo $photo, Request $request, EntityManagerInterface $em): JsonResponse
    {
        //Ajax
        $data = json_decode($request->getContent(), true);
        var_dump($data);

        if($this->isCsrfTokenValid('delete'.$photo->getId(), $data['_token']))
        {
            //pour la supprimer physiquement le fichier sur le disk.
            $nom = $photo->getName();
            //supprime le fichier dans le serveru
            unlink($this->getParameter('image_directory').'/'.$nom);

            $em->remove($photo);
            $em->flush();
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error'=>'Token Invalide'], 400);
        }
    }
}
