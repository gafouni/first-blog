<?php

namespace App\Repository;

use App\Entity\User;

class UserRepository extends CoreRepository{
    public function find(int $id): ?User{
        $pdo_st=$this->pdo->prepare('select * from `user` where id = :id');
        $pdo_st->bindValue(':id',$id);
        $pdo_st->execute();
        $userData=$pdo_st->fetch();
        
        if (empty($userData)){
            return null;

        }
        return new User($userData['id'], $userData['first_name'], $userData['last_name'], $userData['email'], $userData['password'], $userData['status']);
    }

    public function findOneByEmail(string $email): ?User{
        $pdo_st=$this->pdo->prepare('select * from `user` where email = :email');
        $pdo_st->bindValue(':email',$email);
        $pdo_st->execute();
        $userData=$pdo_st->fetch();
        
        if (empty($userData)){
            return null;

        }
        return new User($userData['id'], $userData['first_name'], $userData['last_name'], $userData['email'], $userData['password'], $userData['status']);
    } 

    public function create(){
        $pdo_st=$this->pdo->prepare("INSERT INTO `user` ('first_name', 'last_name', 'email', 'password') VALUES (:first_name, :last_name, :email, :password)");
        $pdo_st->bindValue(':first_name',$first_name);
        $pdo_st->bindValue(':last_name',$last_name);
        $pdo_st->bindValue(':email',$email);
        $pdo_st->bindValue(':password',$password);
        $pdo_st->execute();
        $userData=$pdo_st->fetch();
    
    }    


    public function setSession(){
        $_SESSION['user'] = [
            'id' => $this->id,
            'email' => $this->email
        ];
    }

    
}



