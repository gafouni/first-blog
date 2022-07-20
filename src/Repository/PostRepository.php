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

        $post = new Post($postData['id'], $postData['title'], $postData['author'], $postData['date'], $postData['content'], $postData['active'], $postData['published'], $userRepository->find($postData['id_user']));
        return $post;
    }

    

    public function findAll($active = 1): array{
        $posts=[];
        $pdo_st=$this->pdo->prepare('select * from post WHERE active = :active order by `date` desc');
        $pdo_st->bindValue(':active', $active);
        $pdo_st->execute();
        $postsData=$pdo_st->fetchAll();

        $userRepository = new UserRepository();
        
        foreach($postsData as $postData){
            $posts[]= new Post($postData['id'], $postData['title'], $postData['author'], $postData['date'], $postData['content'], $postData['active'], $postData['published'], $userRepository->find($postData['id_user']));
        }
    
        return $posts;
    }

    public function findAllByUser($user, $active=0): array{
        $posts=[];
        $pdo_st=$this->pdo->prepare('select * from post where id_user= :user_id AND active = :active order by `date` desc');
        $pdo_st->bindValue(':active', $active);
        $pdo_st->bindValue(':user_id', $user->getId());
        $pdo_st->execute();
        $postsData=$pdo_st->fetchAll();

        $userRepository = new UserRepository();
        
        foreach($postsData as $postData){
            $posts[]= new Post($postData['id'], $postData['title'], $postData['author'], $postData['date'], $postData['content'], $postData['active'], $postData['published'], $userRepository->find($postData['id_user']));
        }
    
        return $posts;
    }

    



    public function findAllByMembers($active =1): array{
        $posts=[];
        $pdo_st=$this->pdo->prepare('select * from post p inner join `user` u on p.id_user=u.id where u.status is NULL AND active = :active order by p.`date` desc');
        $pdo_st->bindValue(':active', $active);
        $pdo_st->execute();
        $postsData=$pdo_st->fetchAll();

        $userRepository = new UserRepository();
        
        foreach($postsData as $postData){
            $posts[]= new Post($postData['id'], $postData['title'], $postData['author'], $postData['date'], $postData['content'], $postData['active'], $postData['published'], $userRepository->find($postData['id_user']));
        }
    
        return $posts;
    }

    public function create( Post $post){
        $pdo_st=$this->pdo->prepare("INSERT INTO `post` (`title`, `author`, `date`, `content`, `published`, `id_user`) VALUES (:title, :author, :date, :content, now(), :user)");
        $pdo_st->bindValue(':title',$post->getTitle());
        $pdo_st->bindValue(':author',$post->getAuthor());
        $pdo_st->bindValue(':date',$post->getDate());
        $pdo_st->bindValue(':content',$post->getContent());
        $pdo_st->bindValue(':user',$post->getUser()->getId());
        $pdo_st->execute();   
    
    }    

    public function update(Post $post){
        $pdo_st=$this->pdo->prepare("UPDATE `post` SET `title`=:title, `author`=:author, `date`=:date, `content`=:content WHERE `id`=:id");
        $pdo_st->bindValue(':id',$post->getId());
        $pdo_st->bindValue(':title',$post->getTitle());
        $pdo_st->bindValue(':author',$post->getAuthor());
        $pdo_st->bindValue(':date',$post->getDate());
        $pdo_st->bindValue(':content',$post->getContent());
        
        $pdo_st->execute(); 

    }    

    public function activatePost(Post $post){
        $pdo_st=$this->pdo->prepare("UPDATE `post` SET `active`= '1',  WHERE `id`=:id");
        $pdo_st->bindValue(':id',$post->getId());
        
        $pdo_st->execute(); 

    }

    public function delete(Post $post){
        $pdo_st=$this->pdo->prepare('DELETE from `post` where `id`=:id');
        $pdo_st->bindValue(':id',$post->getId());
        $pdo_st->execute();
        
    }    

}
