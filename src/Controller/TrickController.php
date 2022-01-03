<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Photo;
use App\Entity\Video;
use App\Entity\Comment;

use App\Form\TrickType;
use App\Form\CommentType;


use App\Repository\TrickRepository;
use App\Repository\UserRepository;
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

    public $users;
    public $tricks;

    /**
     * @Route("/dd", name="app_home1", methods={"GET"})
     */
    public function indexBackup(TrickRepository $trickRepository, Request $request): Response
    {
        $limit = 15;
        $page = (int)$request->query->get("page", 1);  // url../?page=
        $tricks = $trickRepository->getPaginatedTricks($page, $limit); //redefini $tricks
        
        $total = $trickRepository->getTotalTricks();

        return $this->render('tricks/index.html.twig', ['tricks'=>$tricks, 'total'=>$total, 'limit'=>$limit, 'page'=>$page]);
    }



    /**
     * @Route("/", name="app_home", methods={"GET"})
     */
    public function index(TrickRepository $trickRepository, Request $request): Response
    {
        // envoyer une requete ajax ?page=2 ect... et recuperer une réponse à afficher ($tricks).
        //A afficher dans la vue   eg:?page=3  requete querybuilder contenant l'item de debut selon calcul de page.
        $limit = 15;

        //[ Récuperation du querystring. ]
        $page = (int)$request->query->get("page", 1);  // url../?page=  int 1, 2, 3 ect

        // [ Les interogations de la Bdd. ]
        $tricks = $trickRepository->getPaginatedTricks($page, $limit);
        $total = $trickRepository->getTotalTricks();
        //dd($tricks);


        //ENVOIE LA REPONSE.
        // Sript php (Serveur) qui repond aux requêtes (Navigateur).
        header('Content-Type: text/html; charset=utf-8');
        if (isset($_GET['page'])) { // recupére la querystring (uri)
            $pagee = $_GET['page'];
            $rt = rand(1,10);
            sleep($rt); //endormir le procesus php xsec? envoie un promise
            //echo"OK";
            //La reponse est le numero de la page demandé.
            echo"Réponse de $pagee => délais de $rt secondes"; 
        }
        // return new JsonResponse($tricks);
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
     * To create Trick
     * @Security("is_granted('ROLE_USER')")
     * @Route("/tricks/create",name="app_tricks_create", methods={"GET","POST"})
     * 
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
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


/**
 * @Route("/test")
 */
    public function test(UserRepository $userRepository, TrickRepository $trickRepository)
    {

        $this->users = $userRepository->findAll();
        $this->tricks = $trickRepository->findAll();

        dd($users, $tricks);
    }
}

 
