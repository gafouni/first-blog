<?php 


    require 'vendor/autoload.php';

    use App\Controller\HomepageController;
    use App\Controller\PostController;
    use App\Controller\UserController;
    

  
   
    $controllerName=$_GET['c'] ?? null;
   switch($controllerName){
      case 'post': 
         $controller=new PostController;
         $controller->display_list();
         break;

      case 'login':
         $controller=new UserController;
         $controller->login();
         break;   

      case 'register':
         $controller=new UserController;
         $controller->register();
         break;    

      default: 
         $controller=new HomepageController;
         $controller->display();  
   }
   
 


