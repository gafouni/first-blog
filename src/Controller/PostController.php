<?php
namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Forms\UpdateForm;
use App\Forms\CommentForm;
use App\Forms\NewPostForm;
use App\Validation\Validator;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;


class PostController extends CoreController{ 
    public function display_list(){
        $postRepository = new PostRepository;
        $posts = $postRepository->findAll();


        $this->twig->display('postpage.html.twig', ['posts'=>$posts]);
        
    }



    public function show($id){
        $postRepository = new PostRepository;
        $post = $postRepository->find($id);
        

 
        //Partie commentaires////////////////////////////////////
        
        //Affichage de la liste des commentaires d'un article
        $commentRepository = new CommentRepository;

        

        
        //var_dump($comments);

        //Creation d'un nouveau commentaire

        if(!empty($this->request->request->get('content'))){
            $content = $this->request->request->get('content');
            $name = $this->request->request->get('name');
            $email = $this->request->request->get('email');
                  
            $comment = new Comment(null, null, $content, $name, $email, null, $post);   

        $commentRepository->create($comment);
        $this->session->set('message', "votre commentaire sera publie tres bientot");
        //header('Location: ?c=show');
        }

        //On recupere la liste des commentaires publies
        $comments= $commentRepository->findAllByPost($post);
        
        //Affichage: article et commentaires
        $form = new CommentForm;

           
        $message = $this->session->get('message') ?? NULL;

        $this->twig->display('showpage.html.twig', [
            'post'=>$post,
            'comments'=>$comments,
            'commentForm' => $form->commentForm()->createForm(),
            'message'=> $message
        ]);    

    }

    
    public function addNewPost(){
        //On verifie si l'utilisateur est connecte
        
        if($this->isConnected() && !empty($this->request->request->get('title'))){
        
            //On verifie si le formulaire est valide
            $validator = new Validator($this->request->request->all());
            $errors =  $validator->validate([
                'title' =>['required'],
                'author' =>['required'],
                'date' =>['required'],
                'content' =>['required'],
                
            ]);
            //var_dump('aaa');
            //die;
            
            if ($errors) {
                //var_dump('bbb');
                $this->session->set('errors[]', $errors);
                $this->redirect('?c=newpost'); 
        //header('location:?c=newPost');
                
            }    

                //Protection contre les failles xss
                $title = strip_tags($this->request->request->get('title'));
                $author = strip_tags($this->request->request->get('author'));
                $date = strip_tags($this->request->request->get('date'));
                $content = strip_tags($this->request->request->get('content'));
                $user = strip_tags($this->request->request->get('user'));

                //On hydrate l'utilisateur et on le stocke en base de donnees
                $postRepository = new PostRepository;

                
                $post = new Post(null, $title, $author, $date, $content, 0, 0, $this->getConnectedUser());
                $postRepository->create($post);
                
                $this->session->set('message', "votre article a ete enregistre, il sera publie tres bientot");
                $this->redirect('?c=profile'); 
        //header('Location: ?c=profile');
            
        }

        $form = new NewPostForm;

        $this->twig->display('newPost.html.twig', ['newPostForm' => $form->newPostForm()->createForm()]);
        
    }

    public function update($id){
        //On verifie que l'article existe dans la base, on va le chercher avec l'id 
        $postRepository = new PostRepository;
        $post = $postRepository->find($id);
        
        //On verifie si l'utilisateur est connecte
        if($this->isConnected() && !empty($this->request->request->get('title'))){
            

            
            
        //Si l'annonce n'existe pas, on retourne a la liste des articles
            if(!$post){
                http_response_code(404);
                $this->session->set('erreur', "L'article recherche n'existe pas");
                $this->redirect('?c=update'); 
        //header('Location:?c=update');
                //exit;
            }

            //On verifie si l'utilisateur est proprietaire de l'article
            if($post->getUser()->getId() !== $this->getConnectedUser()->getId() && !$this->isAdmin()){
                $this->session->set('erreur', "Vous n'avez pas acces a cette page");
                $this->redirect('?c=post'); 
                
                //header('Location:?c=post');
                //exit;
            }

            //On verifie si le formulaire est valide
            $validator = new Validator($this->request->request->all());
            $errors =  $validator->validate([
                'title' =>['required'],
                'author' =>['required'],
                'date' =>['required'],
                'content' =>['required'],
                
            ]);
            //var_dump('aaa');
            //die;
            
            if ($errors) {
                //var_dump('bbb');
                //$_SESSION['errors'][] = $errors;
                $this->session->set('errors[]', $errors);
                $this->redirect('?c=update'); 
                //header('location:?c=update');
                
            }    

                //Protection contre les failles xss
                //$id = strip_tags($_POST['id']);
                $title = strip_tags($this->request->request->get('title'));
                $author = strip_tags($this->request->request->get('author'));
                $date = strip_tags($this->request->request->get('date'));
                $content = strip_tags($this->request->request->get('content'));
                //$user = strip_tags($_POST['user']);

                //On stocke l'article
                //$post = new Post(null, $title, $author, $date, $content, null, $this->getConnectedUser());
                $post->setTitle($title);
                $post->setAuthor($author);
                $post->setDate($date);
                $post->setContent($content);

                $postRepository->update($post);

                if($this->isAdmin()){
                    $this->session->set('message', "Votre article a ete modifie !");
                    $this->redirect('?c=admin');
                    //header('Location:?c=admin');  
                }else{    

                    $this->session->set('message', "Votre article a ete modifie !");
                    $this->redirect('?c=profile'); 
                    //header('Location:?c=profile');  
                }
                //$_SESSION['message'] = "votre article a ete modifie avec succes!";
                //header('Location: ?c=profile');

        }

        //On envoie a la vue
        $form = new UpdateForm;

        $this->twig->display('update.html.twig', ['updateForm' => $form->updateForm($post)->createForm()]);
   
    }

    
    public function delete(int $id){
        if($this->isConnected() && !empty($this->request->request->get('title'))){

            $id = strip_tags($request->query->get('id'));

            $postRepository = new PostRepository;
            $post = $postRepository->find($id);

            //On verifie si le produit existe
            if(!isset($post)){
                $this->session->set('message', "L'article recherche n'existe pas");
                $this->redirect('?c=profile'); 
       // header('Location:?c=profile');
            }    

            $postRepository->delete($post);

            $this->session->set('message', "L'article a ete bien supprime");
                $this->redirect('profile');
                //header('Location:?c=profile');
        }    
    
    }




}