<?php 


   session_start();

    require 'vendor/autoload.php';

    use App\Controller\HomepageController;
    use App\Controller\PostController;
    use App\Controller\UserController;
    use App\Controller\AdminController;

  
   
   $controllerName=$_GET['c'] ?? null;
   $id = $_GET['id'] ?? null;
   switch($controllerName){
      case 'post': 
         $controller=new PostController;
         $controller->display_list();
         break;  

      case 'show': 
         if (!empty($id)) {
            $controller=new PostController;
            $controller->show($id);
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
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

      case 'logout':
         $controller=new UserController;
         $controller->logout();
         break;    


      case 'newPost':
         $controller=new PostController;
         $controller->addNewPost();
         break;   

      case 'update':
         $controller=new PostController;
         $controller->update($id);
         break;  

      case 'activatePost':
         $controller=new AdminController;
         $controller->activatePost($id);
         break;   

      case 'deletePost':
         $controller=new AdminController;
         $controller->deletePost($id);
         break;     

      case 'admin':   
         $controller=new AdminController;
         $controller->allPosts();
         break;   

      case 'comment':
         $controller=new AdminController;
         $controller->displayComments();
         break;     

      case 'activateComment':
         $controller=new AdminController;
         $controller->activateComment($id);
         break;     
         
      case 'deleteComment':
         $controller=new AdminController;
         $controller->deleteComment($id);
         break;          

      case 'message':
         $controller=new AdminController;
         $controller->readMessage();
         break;            

      default: 
         $controller=new HomepageController;
         $controller->display();  
   }
   



