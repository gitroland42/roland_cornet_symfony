<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     * @Route("/article", name="article")
     */
    public function index()
    {

        $repository = $this->getDoctrine()->getRepository(Article::class);
        $mesArticles = $repository->findAll(); 

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $mesArticles,
        ]);
    }




      /**
     * @Route("/article/add", name="addarticle")
     */
    public function addARticle(Request $request,SluggerInterface $slugger)
    {
        
              
        $form = $this->createForm(ArticleType::class, new Article()); 

        // traitememnt bouton valider
        $form->handleRequest($request); 
        if ($form->isSubmitted() && $form->isValid()) { 
            $article = $form->getData(); 
           
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    // $brochureFile->move(
                    //     $this->getParameter('brochures_directory'),
                    //     $newFilename
                    // );
                      $brochureFile->move('../public/images',$newFilename);
                    
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
               
               $article->setImage($newFilename);
              
               
            }
  
                      
            $em = $this->getDoctrine()->getManager(); 
            $em->persist($article); 
            $em->flush(); 
         

                  
           return $this->redirectToRoute('default');
           
        }
        else { 
            dump($form->getErrors() );
            
            return $this->render('article/addarticle.html.twig', [ 
            'form' => $form->createView(), 
            'errorsForm'=>$form->getErrors() 
            ]); 
        }
      
    }


 

     /**
     * @Route("/article/delete/{id}", name="supprarticle")
     */
    public function supprArticle($id)
    {
       
        $monArticle = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager(); 
        $entityManager->remove($monArticle); 
        $entityManager->flush();


        return $this->redirectToRoute('article');

    }




       
    public function editArticle(Article $article,Request $request)
    {
        

        $form = $this->createForm(ArticleType::class, $article); 

        // traitememnt bouton valider
        $form->handleRequest($request); 
        if ($form->isSubmitted() && $form->isValid()) { 
            $article = $form->getData(); 
            $em = $this->getDoctrine()->getManager(); 
            $em->flush(); 
         
            return $this->redirectToRoute('default');
        }
        else { 
            dump($form->getErrors() );
            
            return $this->render('article/editarticle.html.twig', [ 
            'form' => $form->createView(), 
            'errorsForm'=>$form->getErrors(),
            'article'=>$article
            ]); 
        }
      
    }


     /**
     * @Route("/article/{id}", name="voirarticle")
     */
    public function voirArticle($id)
    {
       
         $monArticle = $this->getDoctrine()->getRepository(Article::class)->find($id);

        
        return $this->render('article/vue.html.twig', [ 
        'article' => $monArticle
        ]); 
       
    }
}

