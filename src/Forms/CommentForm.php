<?php
namespace App\Forms;



class CommentForm extends Form{

/**Creation du formulaire de soumission d'un commentaire */
    public function commentForm(){


        return $this->debutForm()
            // ->addLabelFor('date', 'Date de creation :')
            // ->addInput('text', 'date', ['id' => 'date', 'class' =>'form-control'])
            ->addLabelFor('name', 'Pseudo :')
            ->addInput('text', 'name', ['id' => 'name', 'class' =>'form-control'])
            ->addLabelFor('email', 'E-mail :')
            ->addInput('email', 'email', ['id' => 'email', 'class' =>'form-control'])
            ->addLabelFor('contenu', 'Contenu :')
            ->addTextarea('content', '', ['class' => 'form-control'])
            // ->addLabelFor('active', 'Publie :')
            // ->addInput('text', 'active', ['id' => 'active', 'class' => 'form-control'])
            // ->addLabelFor('post', 'Article :')
            // ->addInput('text', 'post', ['id' => 'post', 'class' => 'form-control'])
            ->addButton('Envoyer', ['class' => 'btn btn-primary'])
            ->finForm();

    }    


}