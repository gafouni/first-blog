<?php

namespace App\Controller;

class CoreController
{
   protected $twig;
   
   public function __construct() {
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $this->twig = new \Twig\Environment($loader);
   }

   public function isConnected(){
      return(!empty($this->getConnectedUser()) && (!empty($this->getConnectedUser()->getId())));

   }

   public function getConnectedUser(){
      
      return(unserialize($_SESSION['user']));
   }

   public function isAdmin(){
      
      return(!empty($this->getConnectedUser()->getStatus()) == 'ROLE_ADMIN');
   }
   
}
