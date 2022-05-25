<?php
namespace App\Forms;



class LoginForm extends Form{

/**Creation du formulaire de connexion */
    public function loginForm(){


        return $this->debutForm()
            ->addLabelFor('email', 'E-mail :')
            ->addInput('email', 'email', ['id' => 'email', 'class' =>'form-control'])
            ->addLabelFor('pass', 'Mot de passe :')
            ->addInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
            ->addButton('Me connecter', ['class' => 'btn btn-primary'])
            ->finForm();

            
    }    

}