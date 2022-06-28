<?php

namespace App\Controller;

use App\Controller\CoreController;
use App\Repository\PostRepository;

class AdminController extends CoreController{

    public function allPosts(){
        if($this->isAdmin()){
            $postRepository = new PostRepository;
            $posts = $postRepository->findAll();
        }else{
            $_SESSION['message']="Vous n'avez pas acces a cette page";
            header('Location:?c=profile');
        }

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
