<?php

namespace App\Repository;

use App\Entity\Message;

Class MessageRepository extends CoreRepository{

    public function find(Int $id): ?Message{
        
        $pdo_st=$this->pdo->prepare('select * from `message` where `id`=:id');
        $pdo_st->bindValue(':id',$id);
        $pdo_st->execute();
        $postData=$pdo_st->fetch();
        
        if (empty($postData)){
            return null;
        }

        $message = new Message($postData['id'], $postData['name'], $postData['email'], $postData['date'], $postData['subject'], $postData['content']);
        
        return $message;

    }

    public function findAll(): array{
        
        $messages=[];
        $pdo_st=$this->pdo->prepare('select * from `message` order by `date` desc');
        
        $pdo_st->execute();
        $postsData=$pdo_st->fetchAll();

        
        foreach($postsData as $postData){
            $messages[]= new Message($postData['id'], $postData['name'], $postData['email'], $postData['date'], $postData['subject'], $postData['content']);
        }

        return $messages;
    }


    public function create( Message $message){
        $pdo_st=$this->pdo->prepare("INSERT INTO `message` (`name`, `email`, `date`, `subject`, `content`) VALUES (:name, :email, now(), :subject, :content)");
        $pdo_st->bindValue(':name',$message->getName());
        $pdo_st->bindValue(':email',$message->getEmail());
        $pdo_st->bindValue(':subject',$message->getSubject());
        $pdo_st->bindValue(':content',$message->getContent());
        //$pdo_st->bindValue(':user',$message->getUser()->getId());
        $pdo_st->execute();   
    
    }    


    public function delete(Message $message){
        $pdo_st=$this->pdo->prepare('DELETE from `message` where `id`=:id');
        $pdo_st->bindValue(':id', $message->getId());
        $pdo_st->execute();

    }







}