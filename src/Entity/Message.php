<?php

namespace App\Entity;

class Message{

    private int $id;
    private string $name;
    private string $email;
    private string $date;
    private string $subject;
    private string $content;

    public function __construct($id, $name, $email, $date, $subject, $content)
    {
        $this->id = $id;
        $this->name = $name;
        $this->name = $email;
        $this->date = $date;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
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
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    public function getSubject()
    {
        return $this->subject;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function getContent()
    {
        return $this->content;
    }

}