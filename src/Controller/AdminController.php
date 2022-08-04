<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Controller\CoreController;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\MessageRepository;

class AdminController extends CoreController{

    public function allPosts(){
        if($this->isAdmin()){
            $postRepository = new PostRepository;
            $user = $this->getConnectedUser();
            $posts = $postRepository->findAllByUser($user, 0);

            $membersPosts = $postRepository->findAllByMembers(0);
            //var_dump($membersPosts);
        }else{
            $this->session->set('message', "Vous n'avez pas acces a cette page");
            //header('Location:?c=profile');
            $this->redirect('?c=profile');
        }

        $message = $this->session->get('message') ?? NULL;
        
        $this->twig->display('admin.html.twig', ['posts'=>$posts, 'membersPosts'=>$membersPosts, 'message'=>$message]);
          //var_dump($posts);
          //var_dump($membersPosts);

    }

    public function activatePost(int $id){
        $postRepository = new PostRepository;
        $post = $postRepository->find($id);
        
        
        $postRepository->activatePost($post);
        //var_dump('$post');
        $this->redirect('?c=admin'); 

    }


    public function deletePost(int $id){

        $postRepository = new PostRepository;
        $post = $postRepository->find($id);
        var_dump($post);
        die;
        
        $postRepository = new PostRepository;
        $postRepository->delete($post);

        $this->session->set('message', "L'article a ete bien supprime");
        $this->redirect('?c=admin'); 
        //header('Location:?c=admin');
        
    }

    public function displayComments(){
               
            $commentRepository = new CommentRepository;
            $comments = $commentRepository->findAll(0);
          
        $this->twig->display('comment.html.twig', ['comments'=>$comments]);
        //var_dump($comments);
        

            
    }

    public function activateComment(int $id){

        $commentRepository = new CommentRepository;
        $comment = $commentRepository->find($id);

        $commentRepository->activate($comment);

        $this->redirect('?c=comment'); 
        //header('Location: ?c=comment');       
            
         
    }

    public function deleteComment(int $id){

        $commentRepository = new CommentRepository;
        $comment = $commentRepository->find($id);
        
        $commentRepository = new CommentRepository;
        $commentRepository->delete($comment);

        $this->session->set('message', "L'article a ete bien supprime");
        $this->redirect('?c=admin'); 
        //header('Location:?c=admin');
        
    }
        

    public function displayMessage(){

        $messageRepository = new MessageRepository;
        $messages = $messageRepository->findAll();
          
        $this->twig->display('message.html.twig', ['messages'=>$messages]);

    }

    public function deleteMessage(int $id){

        $messageRepository = new MessageRepository;
        $message = $messageRepository->find($id);
        
        //$commentRepository = new CommentRepository;
        $messageRepository->delete($message);

        $this->session->set('message',  "Le message a ete bien supprime");
        $this->redirect('?c=message'); 
        //header('Location:?c=message');
        
    }





}
