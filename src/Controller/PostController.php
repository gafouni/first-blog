<?php
namespace App\Controller;
use App\Entity\Post;
use App\Forms\NewPostForm;
use App\Repository\PostRepository;

class PostController extends CoreController{ 
    public function display_list(){
        $postRepository = new PostRepository;
        $posts = $postRepository->findAll();
        

        echo $this->twig->render('postpage.html.twig', ['posts'=>$posts]);
        
    }

    public function show($id){
        $postRepository = new PostRepository;
        $post = $postRepository->find($id);
        

        echo $this->twig->render('showpage.html.twig', ['post'=>$post]);
        
    }
    
    public function addNewPost(){

        //On verifie si le formulaire est valide
        $validator = new Validator($_POST);
        $errors =  $validator->validate([
            'title' =>['required'],
            'author' =>['required'],
            'date' =>['required'],
            'content' =>['required'],
            'user' =>['required']
        ]);

        if ($errors) {
            $_SESSION['errors'][] = $errors;
            header('location:/newPost');
            exit;
        }    

            //Protection contre les failles xss
            $title = strip_tags($_POST['title']);
            $author = strip_tags($_POST['author']);
            $date = strip_tags($_POST['date']);
            $content = strip_tags($_POST['content']);
            $user = strip_tags($_POST['user']);

            // On hydrate l'utilisateur et on le stocke en base de donnees
            $postRepository = new PostRepository;

            $post = new Post(null, $title, $author, $date, $content, null, $_SESSION['user']['id']);
            $post->create();

            $_SESSION['message'] = "votre article a ete cree avec succes!";
        


        $form = new NewPostForm;

        echo $this->twig->render('newPost.html.twig', ['newPostForm' => $form->newPostForm()->createForm()]);


    }
}