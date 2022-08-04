<?php
namespace App\Forms;



class NewPostForm extends Form{

/**Creation du formulaire d'ajout d'un nouvel article */
    public function newPostForm(){


    return $this->debutForm()
            ->addLabelFor('title', 'Titre de l\'article :')
            ->addInput('text', 'title', ['id' => 'title', 'class' =>'form-control'])
            ->addLabelFor('author', 'Auteur :')
            ->addInput('text', 'author', ['id' => 'author', 'class' => 'form-control'])
            ->addLabelFor('date', 'Date :')
            ->addInput('date', 'date', ['id' => 'date', 'class' =>'form-control'])
            ->addLabelFor('content', 'Contenu de l\'article :')
            ->addTextarea('content', '', ['id' => 'content', 'class' => 'form-control'])
            // ->addLabelFor('published', 'Publie le :')
            // ->addInput('date', 'publie', ['id' => 'published', 'class' => 'form-control'])
            // ->addLabelFor('user', 'Propose par :')
            // ->addInput('text', 'user', ['id' => 'user', 'class' => 'form-control'])
            ->addButton('Ajouter', ['class' => 'btn btn-secondary'])
            ->finForm();
    }    

}