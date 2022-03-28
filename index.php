<?php 


    require 'vendor/autoload.php';

    use App\Controller\HomepageController;
    use App\Controller\PostController;

  

   
    /* $controller=new HomepageController;
    $controller->display();
 */
    $controller=new PostController;
    $controller->display_list();


