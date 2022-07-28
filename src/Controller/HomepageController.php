<?php

namespace App\Controller;

use App\Entity\Message;
use App\Forms\MessageForm;
use App\Repository\MessageRepository;

class HomepageController extends CoreController{
    public function display(){

           

        if(!empty($this->request->request->get('content'))){
            
            $name = $this->request->request->get('name');
            $email = $this->request->request->get('email');
            $subject = $this->request->request->get('subject');
            $content = $this->request->request->get('content');
                  
            $message = new Message(null, $name, $email, null, $subject, $content);   
        
        $messageRepository = new MessageRepository;    
        $messageRepository->create($message);
        //var_dump('$message');
        $this->session->set('message', "votre message a ete enregistre, vous recevrez une reponse tres bientot");
        header('Location: ?c=default');
        }       
       
        $form = new MessageForm;

        echo $this->twig->render('homepage.html.twig', ['messageForm'=> $form->messageForm()->createForm()]);
        
       
        //echo $this->twig->render('homepage.html.twig');
    }

    public function AddMessage(){
        
        // if(!empty($_POST['content'])){
            
        //     $name = $_POST['name'];
        //     $email = $_POST['email'];
        //     $subject = $_POST['subject'];
        //     $content = $_POST['content'];
                  
        //     $message = new Message(null, $name, $email, null, $subject, $content);   
        
        // $messageRepository = new MessageRepository;    
        // $messageRepository->create($message);
        // //var_dump('$message');
        // $_SESSION['message'] = "votre message a ete enregistre, vous recevrez une reponse tres bientot";
        // header('Location: ?c=default');
        // }       
       
        $form = new MessageForm;

        echo $this->twig->render('homepage.html.twig', ['messageForm'=> $form->messageForm()->createForm()]);
        
    }








}
