<?php 


   //session_start();

    require 'vendor/autoload.php';

    use App\Controller\HomepageController;
    use App\Controller\PostController;
    use App\Controller\UserController;
    use App\Controller\AdminController;
    use Symfony\Component\HttpFoundation\Request;

    $request = Request::createFromGlobals();
    //$request->query->get('id');
  
   
   $controllerName=$request->query->get('c') ?? null;
   $id = $request->query->get('id') ?? null;
   switch($controllerName){
      case 'post': 
         $controller=new PostController;
         $controller->display_list();
         break;  

      case 'show': 
         
         $controller=new PostController;
         $controller->show($id);
        
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
         $controller->displayMessage();
         break;            

      case 'deleteMessage':
         $controller = new AdminController;
         $controller->deleteMessage($id); 
         break;  

      default: 
         $controller=new HomepageController;
         $controller->display();  
   }
   



