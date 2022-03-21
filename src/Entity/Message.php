<?php

namespace App\Entity;

class Message{

    private int $id;
    private string $date;
    private string $subject;
    private string $content;

    public function __construct($id, $date, $subject, $content)
    {
        $this->id = $id;
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