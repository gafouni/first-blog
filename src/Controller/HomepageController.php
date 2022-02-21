<?php

namespace App\Controller;

class HomepageController{
    public function display(){
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader);
        echo $twig->render('homepage.html.twig');
    }
}
