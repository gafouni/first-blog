<?php 

   session_start();

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

      case 'show': 
         if (isset($_GET['id']) && $_GET['id'] > 0) {
            $controller=new PostController;
            $controller->show($id);
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }

         // $controller=new PostController;
         // $controller->show($id);
         break;   


      case 'login':
         $controller=new UserController;
         $controller->login();
         break;   

      case 'register':
         $controller=new UserController;
         $controller->register();
         break;    

      case 'profile':
         $controller=new UserController;
         $controller->profile();
         break;    

      default: 
         $controller=new HomepageController;
         $controller->display();  
   }
   

// require('controller.php');

// if (isset($_GET['c'])) {
//     if ($_GET['action'] == 'listPosts') {
//         listPosts();
//     }
//     elseif ($_GET['action'] == 'post') {
//         if (isset($_GET['id']) && $_GET['id'] > 0) {
//             post();
//         }
//         else {
//             echo 'Erreur : aucun identifiant de billet envoyé';
//         }
//     }
// }
// else {
//     listPosts();
// }
 


