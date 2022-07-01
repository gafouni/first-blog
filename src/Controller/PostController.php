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


        echo $this->twig->render('postpage.html.twig', ['posts'=>$posts]);
        
    }

    public function show($id){
        $postRepository = new PostRepository;
        $post = $postRepository->find($id);
        

        //Partie commentaires/////////////////////////////////////////////////////////////////
        
        
        //$form = new CommentForm;
    
        //Traitement du formulaire
        //Affichage de la liste des commentaires d'un article
        $commentRepository = new CommentRepository;
        $comments= $commentRepository->findAllByPost($post);
        //$comments= $commentRepository->findAll();
        
        //var_dump($comments);

        //Creation d'un nouveau commentaire

        $content = $_POST['content'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $post = $_POST['post'];

        $commentRepository = new CommentRepository;
        $comment = new Comment(null, null, $content, $name, $email, null, $this->getPost());

        // $comment->setContent($content)
        //         ->setName($name)
        //         ->setEmail($email)
        //         ->setPost($post);

        $commentRepository->create($comment);

        
        $form = new CommentForm;

        echo $this->twig->render('showpage.html.twig', [
            'post'=>$post,
            'comments'=>$comments,
            'commentForm' => $form->commentForm()->createForm()
        ]);
        
        

    }
    
    public function addNewPost(){
        //On verifie si l'utilisateur est connecte
        
        if($this->isConnected() && !empty($_POST['title'])){
        
            //On verifie si le formulaire est valide
            $validator = new Validator($_POST);
            $errors =  $validator->validate([
                'title' =>['required'],
                'author' =>['required'],
                'date' =>['required'],
                'content' =>['required'],
                
            ]);
            //var_dump('aaa');
            //die;
            
            if ($errors) {
                var_dump('bbb');
                $_SESSION['errors'][] = $errors;
                header('location:?c=newPost');
                exit;
            }    

                //Protection contre les failles xss
                $title = strip_tags($_POST['title']);
                $author = strip_tags($_POST['author']);
                $date = strip_tags($_POST['date']);
                $content = strip_tags($_POST['content']);
                $user = strip_tags($_POST['user']);

                //On hydrate l'utilisateur et on le stocke en base de donnees
                $postRepository = new PostRepository;

                
                $post = new Post(null, $title, $author, $date, $content, null, $this->getConnectedUser());
                $postRepository->create($post);
                
                $_SESSION['message'] = "votre article a ete cree avec succes!";
                header('Location: ?c=profile');
            
        }

        $form = new NewPostForm;

        echo $this->twig->render('newPost.html.twig', ['newPostForm' => $form->newPostForm()->createForm()]);
        
    }

    public function update($id){
        //On verifie que l'article existe dans la base, on va le chercher avec l'id 
        $postRepository = new PostRepository;
        $post = $postRepository->find($id);
        
        //On verifie si l'utilisateur est connecte
        if($this->isConnected() && !empty($_POST['title'])){
            

            
            
        //Si l'annonce n'existe pas, on retourne a la liste des articles
            if(!$post){
                http_response_code(404);
                $_SESSION['erreur'] = "L'article recherche n'existe pas";
                header('Location:?c=update');
                exit;
            }

            //On verifie si l'utilisateur est proprietaire de l'article
            if($post->getUser()->getId() !== $this->getConnectedUser()->getId() && !$this->isAdmin()){
                $_SESSION['erreur'] = "Vous n'avez pas acces a cette page";
                header('Location:?c=post');
                exit;
            }

            //On verifie si le formulaire est valide
            $validator = new Validator($_POST);
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
                $_SESSION['errors'][] = $errors;
                header('location:?c=update');
                exit;
            }    

                //Protection contre les failles xss
                //$id = strip_tags($_POST['id']);
                $title = strip_tags($_POST['title']);
                $author = strip_tags($_POST['author']);
                $date = strip_tags($_POST['date']);
                $content = strip_tags($_POST['content']);
                //$user = strip_tags($_POST['user']);

                //On stocke l'article
                //$post = new Post(null, $title, $author, $date, $content, null, $this->getConnectedUser());
                $post->setTitle($title);
                $post->setAuthor($author);
                $post->setDate($date);
                $post->setContent($content);

                $postRepository->update($post);

                if($this->isAdmin()){
                    $_SESSION['message'] = "Votre article a ete modifie !";
                    header('Location:?c=admin');  
                }else{    

                    $_SESSION['message'] = "Votre article a ete modifie !";
                    header('Location:?c=profile');  
                }
                //$_SESSION['message'] = "votre article a ete modifie avec succes!";
                //header('Location: ?c=profile');

        }

        //On envoie a la vue
        $form = new UpdateForm;

        echo $this->twig->render('update.html.twig', ['updateForm' => $form->updateForm($post)->createForm()]);
   
    }

    public function delete(int $id){
        if($this->isConnected() && !empty($_POST['title'])){

            $id = strip_tags($_GET['id']);

            $postRepository = new PostRepository;
            $post = $postRepository->find($id);

            //On verifie si le produit existe
            if(!$post){
                $_SESSION['message'] = "L'article recherche n'existe pas";
                header('Location:?c=profile');
            }    

            $postRepository->delete($post);

            $_SESSION['message'] = "L'article a ete bien supprime";
                header('Location:?c=profile');
        }    
    
    }




}