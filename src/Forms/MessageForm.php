<?php
namespace App\Forms;



class MessageForm extends Form{

/**Creation du formulaire d'envoi d'un message */
    public function messageForm(){


        return $this->debutForm()
            ->addLabelFor('date', 'Date :')
            ->addInput('text', 'date', ['id' => 'date', 'class' =>'form-control'])
            ->addLabelFor('name', 'Pseudo :')
            ->addInput('text', 'name', ['id' => 'name', 'class' =>'form-control'])
            ->addLabelFor('email', 'E-mail :')
            ->addInput('email', 'email', ['id' => 'email', 'class' =>'form-control'])
            ->addLabelFor('subject', 'Objet :')
            ->addInput('text', 'subject', ['id' => 'subject', 'class' =>'form-control'])

            ->addLabelFor('content', 'Contenu :')
            ->addTextarea('content', '', ['class' => 'form-control'])
            // ->addLabelFor('active', 'Publie :')
            // ->addInput('text', 'active', ['id' => 'active', 'class' => 'form-control'])
            // ->addLabelFor('post', 'Article :')
            // ->addInput('text', 'post', ['id' => 'post', 'class' => 'form-control'])
            ->addButton('Envoyer', ['class' => 'btn btn-primary'])
            ->finForm();

    }    


}