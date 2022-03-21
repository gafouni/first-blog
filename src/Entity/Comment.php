<?php

namespace App\Entity;

class Comment {

    private int $id;
    private string $date;
    private string $content;
    private tinyint $published;

    public function __construct($id, $date, $content, $published){
        $this->id = $id;
        $this->date = $date;
        $this->content = $content;
        $this->published = $published;
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
    public function setPublished($published)
    {
        $this->published = $published;
    }
    public function getPublished()
    {
        return $this->published;
    }


}





