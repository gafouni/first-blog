<?php
namespace App\Entity;

class Post{
    private ?int $id;
    private string $date;
    private string $author;
    private string $title;
    private string $content;
    private ?string $published;
    private User $user;


    public function __construct($id, $title, $author, $date, $content, $published, $user){
      $this->id = $id;
      $this->title = $title;
      $this->date = $date;
      $this->author = $author;
      $this->content = $content;
      $this->published = $published;
      $this->user = $user;
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
    public function setTitle($title)
    {
      $this->title = $title;
    }
    public function getTitle()
    {
      return $this->title;
    }
    public function setAuthor($author)
    {
      $this->author = $author;
    }
    public function getAuthor()
    {
      return $this->author;
    }
    public function setContent($content)
    {
      $this->content = $content;
    }
    public function getContent()
    {
      return $this->content;
    }
    public function setPublished($published)
    {
      $this->published = $published;
    }
    public function getPublished()
    {
      return $this->published;
    }
    public function setUser($user)
    {
      $this->user = $user;
    }
    public function getUser()
    {
      return $this->user;
    }
}