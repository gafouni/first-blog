<?php
namespace App\Controller;

use App\Forms\LoginForm; 
use App\Forms\RegisterForm;

class UserController extends CoreController{

    /**Creation du formulaire de connexion */
    public function login(){

        $form = new LoginForm;

        // $form->debutForm()
        //     ->addLabelFor('email', 'E-mail :')
        //     ->addInput('email', 'email', ['id' => 'email', 'class' =>'form-control'])
        //     ->addLabelFor('pass', 'Mot de passe :')
        //     ->addInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
        //     ->addButton('Me connecter', ['class' => 'btn btn-primary'])
        //     ->finForm();

         echo $this->twig->render('login.html.twig', ['loginForm' => $form->createForm()]);

    }

    public function register(){

        $form = new RegisterForm;

        echo $this->twig->render('register.html.twig', ['registerForm' => $form->createForm()]);


    }




}