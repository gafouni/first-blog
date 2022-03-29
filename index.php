<?php 


    require 'vendor/autoload.php';

    use App\Controller\HomepageController;
    use App\Controller\PostController;

  
   
    $controllerName=$_GET['c'] ?? null;
   switch($controllerName){
      case 'post': 
         $controller=new PostController;
         $controller->display_list();
         break;

      default: 
         $controller=new HomepageController;
         $controller->display();  
   }
   
 


