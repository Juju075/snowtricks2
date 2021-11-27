<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Trick;
use App\Entity\Comment;

use App\Form\TrickType;

use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
                $trick->addPhoto($img);

                // $fk = $trick->getId();
                // $img->setTrickId($fk); 
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
    * @Route("/tricks/{id<[0-9]+>}", name="app_tricks_show", methods={"GET"})
    */
    public function show(Trick $trick):Response
    {
        return $this->render('tricks/show.html.twig', compact('trick'));
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
            $images = $form->get('images')->getData();
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
                $trick->addPhoto($img);

                // $fk = $trick->getId();
                // $img->setTrickId($fk); 
            }




                $em->persist($trick);
                $em->flush();
        }
        return $this->renderForm('tricks/edit.html.twig',['form'=>$form]);
    }
    /**
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
