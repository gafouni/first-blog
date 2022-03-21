<?php

namespace App\Controller;

class HomepageController extends CoreController{
    public function display(){
       
        echo $this->twig->render('homepage.html.twig');
    }
}
