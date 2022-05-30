<?php

namespace App\Entity;

class User{
    private ?int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;
    private ?string $status;

    public function __construct($id, $first_name, $last_name, $email, $password, $status){
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }
    public function getFirstName()
    {
        return $this->first_name;
    }
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }
    public function getLastName()
    {
        return $this->last_name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }






}



