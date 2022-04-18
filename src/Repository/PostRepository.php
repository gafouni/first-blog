<?php
namespace App\Repository;
use App\Entity\Post;

class PostRepository extends CoreRepository{
    public function find($id): ?Post{
        $pdo_st=$this->pdo->prepare('select * from post where \:id = $id');
        $pdo_st->bindValue(':id',$id);
        $pdo_st->execute();
        $postData=$pdo_st->fetch();
        
        if (empty($postData)){
            return null;

        }

        $userRepository = new UserRepository();


        $post = new Post($postData['id'], $postData['title'], $postData['author'], $postData['date'], $postData['content'], $postData['published'], $userRepository->find($postData['id_user']));
    
        return $post;
    }
    public function findAll(): array{
        $posts=[];
        $pdo_st=$this->pdo->prepare('select * from post order by `date` desc');
        $pdo_st->execute();
        $postsData=$pdo_st->fetchAll();

        $userRepository = new UserRepository();
        
        foreach($postsData as $postData){
            $posts[]= new Post($postData['id'], $postData['title'], $postData['author'], $postData['date'], $postData['content'], $postData['published'], $userRepository->find($postData['id_user']));
        }
    
        return $posts;
    }

    
}
