<?php
namespace App\Repository;

use App\Entity\Comment;
use App\Repository\PostRepository;


class CommentRepository extends CoreRepository{
    public function find(int $id): ?Comment{
        $pdo_st=$this->pdo->prepare('select * from `comment` where `id`=:id');
        $pdo_st->bindValue(':id',$id);
        $pdo_st->execute();
        $commentData=$pdo_st->fetch();
        
        if (empty($commentData)){
            return null;

        }

        $postRepository = new PostRepository();


        $comment = new Comment(
            $commentData['id'], 
            $commentData['date'], 
            $commentData['content'], 
            $commentData['name'], 
            $commentData['email'], 
            $commentData['active'],            
            $postRepository->find($commentData['id_post'])
        );
    
        return $comment;
    }

    public function findAll(): array{
        $comments=[];
        $pdo_st=$this->pdo->prepare('select * from `comment` order by `date` desc');
        $pdo_st->execute();
        $commentsData=$pdo_st->fetchAll();

        $postRepository = new PostRepository();
        
        foreach($commentsData as $commentData){
            $comments[]= new Comment(
                $commentData['id'], 
                $commentData['date'], 
                $commentData['content'], 
                $commentData['name'], 
                $commentData['email'], 
                $commentData['active'], 
                 
                $postRepository->find($commentData['id_post']));
        }
    
        return $comments;
    }

    public function findAllByPost($post): array{
        $comments=[];
        $pdo_st=$this->pdo->prepare('select * from `comment` where id_post = :post_id AND active = 1 order by `date` desc');
        $pdo_st->bindValue(':post_id', $post->getId());
        $pdo_st->execute();
        $commentsData=$pdo_st->fetchAll();
        
        $postRepository = new PostRepository();
        
        foreach($commentsData as $commentData){
            $comments[]= new Comment(
                $commentData['id'], 
                $commentData['date'], 
                $commentData['content'], 
                $commentData['name'], 
                $commentData['email'], 
                $commentData['active'],
                $postRepository->find($commentData['id_post'])
            );
        }
    
        return $comments;
    }

    public function create(Comment $comment){
        $pdo_st=$this->pdo->prepare("INSERT INTO `comment` (`date`, `content`, `name`, `email`, `id_post`) VALUES (now(), :content, :name, :email, :post)");
        $pdo_st->bindValue(':content',$comment->getContent());
        $pdo_st->bindValue(':name',$comment->getname());
        $pdo_st->bindValue(':email',$comment->getemail());
        $pdo_st->bindValue(':post',$comment->getPost()->getId());
        $pdo_st->execute();   
    
    }    

    public function delete(Comment $comment){
        $pdo_st=$this->pdo->prepare('DELETE from `comment` where `id`=:id');
        $pdo_st->bindValue(':id',$comment->getId());
        $pdo_st->execute();
        
    }    

}    
