<?php
namespace App\Repository;
use App\Entity\Post;
use App\Repository\UserRepository;

class PostRepository extends CoreRepository{
    public function find(int $id): ?Post{
        $pdo_st=$this->pdo->prepare('select * from `post` where `id`=:id');
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

    public function findAllByUser($user): array{
        $posts=[];
        $pdo_st=$this->pdo->prepare('select * from post where user_id = :user_id order by `date` desc');
        $pdo_st->bindValue('user_id', $user->getId());
        $pdo_st->execute();
        $postsData=$pdo_st->fetchAll();

        $userRepository = new UserRepository();
        
        foreach($postsData as $postData){
            $posts[]= new Post($postData['id'], $postData['title'], $postData['author'], $postData['date'], $postData['content'], $postData['published'], $userRepository->find($postData['id_user']));
        }
    
        return $posts;
    }

    public function create( Post $post){
        $pdo_st=$this->pdo->prepare("INSERT INTO `post` (`title`, `author`, `date`, `content`, `published`, `user`) VALUES (:title, :author, :date, :content, now(), :user)");
        $pdo_st->bindValue(':title',$post->getTitle());
        $pdo_st->bindValue(':author',$post->getAuthor());
        $pdo_st->bindValue(':date',$post->getDate());
        $pdo_st->bindValue(':content',$post->getContent());
        $pdo_st->bindValue(':user',$post->getUser()->getId());
        $pdo_st->execute();   
    
    }    

    public function update(int $id){
        $pdo_st=$this->pdo->prepare("UPDATE `post` SET `title`=:title, `author`=:author, `date`=:date, `content`=:content, `user`=:user WHERE `id`=:id");
        $pdo_st->bindValue(':title',$post->getTitle());
        $pdo_st->bindValue(':author',$post->getAuthor());
        $pdo_st->bindValue(':date',$post->getDate());
        $pdo_st->bindValue(':content',$post->getContent());
        $pdo_st->bindValue(':user',$post->getUser()->getId());
        $pdo_st->execute(); 

    }    

    

}
