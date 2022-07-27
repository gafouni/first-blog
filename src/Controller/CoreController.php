<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class CoreController
{
   protected $twig;
   protected $session;
   
   public function __construct() {
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $this->twig = new \Twig\Environment($loader);
    $this->session = new Session();
    $this->session->start();
   }

   public function isConnected(){
      return(!empty($this->getConnectedUser()) && (!empty($this->getConnectedUser()->getId())));

   }

   public function getConnectedUser(){
      
      return(unserialize($this->session->get('user')));
   }

   public function isAdmin(){
      
      return(($this->getConnectedUser()->getStatus()) == 'ROLE_ADMIN');
   }
   
}
