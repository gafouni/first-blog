<?php
namespace App\Forms;



class RegisterForm extends Form{

/**Creation du formulaire de connexion */
    public function registerForm(){


    return $this->debutForm()
            ->addLabelFor('prenom', 'Prenom :')
            ->addInput('text', 'prenom', ['id' => 'prenom', 'class' =>'form-control'])
            ->addLabelFor('nom', 'Nom :')
            ->addInput('text', 'nom', ['id' => 'nom', 'class' => 'form-control'])->addLabelFor('email', 'E-mail :')
            ->addInput('email', 'email', ['id' => 'email', 'class' =>'form-control'])
            ->addLabelFor('pass', 'Mot de passe :')
            ->addInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
            ->addLabelFor('statut', 'Statut :')
            ->addSelect('statut', ['adminitrateur', 'membre', 'visiteur'], ['id'=>'statut', 'class'=>'form-control'])
            ->addButton('M\'inscrire', ['class' => 'btn btn-primary'])
            ->finForm();
    }    

}