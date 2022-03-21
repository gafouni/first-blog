<?php

namespace App\Controller;

class CoreController
{
   protected $twig;
   public function __construct() {
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $this->twig = new \Twig\Environment($loader);
   }
}
