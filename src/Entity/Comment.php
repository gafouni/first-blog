<?php

namespace App\Entity;

class Comment {

    private ?int $id;
    private string $date;
    private string $content;
    private string $name;
    private string $email;
    private ?string $active;
    private Post $post;

    public function __construct($id, $date, $content, $name, $email, $active, $post){
        $this->id = $id;
        $this->date = $date ?? date('Y-m-d');
        $this->content = $content;
        $this->name = $name;
        $this->email = $email;
        $this->active = $active;
        $this->post = $post;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setActive($active)
    {
        $this->active = $active;
    }
    public function getActive()
    {
        return $this->active;
    }
    public function setPost($post)
    {
      $this->post = $post;
    }
    public function getPost()
    {
      return $this->post;
    }

}





