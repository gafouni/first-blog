<?php
namespace App\Controller;
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
}