<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Controller\CoreController;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;

class AdminController extends CoreController{

    public function allPosts(){
        if($this->isAdmin()){
            $postRepository = new PostRepository;
            $user = $this->getConnectedUser();
            $posts = $postRepository->findAllByUser($user);

            $membersPosts = $postRepository->findAllByMembers();

        }else{
            $_SESSION['message']="Vous n'avez pas acces a cette page";
            header('Location:?c=profile');
        }

        echo $this->twig->render('admin.html.twig', ['posts'=>$posts, 'membersPosts'=>$membersPosts]);
          //var_dump($posts);
          //var_dump($membersPosts);

    }

    public function deletePost(int $id){

        $postRepository = new PostRepository;
        $post = $postRepository->find($id);
        
        $postRepository = new PostRepository;
        $postRepository->delete($post);

        $_SESSION['message'] = "L'article a ete bien supprime";
        header('Location:?c=admin');
        
    }

    public function displayComments(){
        
        //if(!empty($_POST['content'])){
           
            $commentRepository = new CommentRepository;
            $comments = $commentRepository->findAll(0);
            //var_dump($comments);
            //die;
        //}        
        echo $this->twig->render('comment.html.twig', ['comments'=>$comments]);
        //var_dump($comments);
        

            
    }

    public function activateComment(int $id){

        $commentRepository = new CommentRepository;
        $comment = $commentRepository->find($id);

        //$comment->setActive(true);

        //var_dump($comment);
        
        
            
           

            //$comment = new Comment(null, null, $content, $name, $email, null, $post);
         $commentRepository->activate($comment);

         header('Location: ?c=comment');       
            //echo $this->twig->render('comment.html.twig', ['comment'=>$comment]);
            //var_dump($comment);
         
    }

    public function deleteComment(int $id){

        $commentRepository = new CommentRepository;
        $comment = $commentRepository->find($id);
        
        $commentRepository = new CommentRepository;
        $commentRepository->delete($comment);

        $_SESSION['message'] = "L'article a ete bien supprime";
        header('Location:?c=admin');
        
    }
        

    public function readMessage(){


    }
}
