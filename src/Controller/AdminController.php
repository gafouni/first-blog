<?php

namespace App\Controller;

use App\Controller\CoreController;
use App\Repository\PostRepository;

class AdminController extends CoreController{
    //if($this->isConnected() && $this->isAdmin()){

        public function allPosts(){
            
            $postRepository = new PostRepository;
            $posts = $postRepository->findAll();
            

            echo $this->twig->render('admin.html.twig', ['posts'=>$posts]);
                    
        }

        public function deletePost(int $id){

            $postRepository = new PostRepository;
            $post = $postRepository->find($id);
            
            $postRepository = new PostRepository;
            $postRepository->delete($post);

            $_SESSION['message'] = "L'article a ete bien supprime";
            header('Location:?c=admin');
            
        }

}
