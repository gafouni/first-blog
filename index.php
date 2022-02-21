<?php 
    require 'vendor/autoload.php';

    use App\Controller\HomepageController;


    $controller=new HomepageController;
    $controller->display();
