<?php
namespace App\Forms;



class NewPostForm extends Form{

/**Creation du formulaire d'ajout d'un nouvel article */
    public function newPostForm(){


    return $this->debutForm()
            ->addLabelFor('titre', 'Titre de l\'article :')
            ->addInput('text', 'titre', ['id' => 'titre', 'class' =>'form-control'])
            ->addLabelFor('auteur', 'Auteur :')
            ->addInput('text', 'auteur', ['id' => 'auteur', 'class' => 'form-control'])
            ->addLabelFor('date', 'Date :')
            ->addInput('date', 'date', ['id' => 'date', 'class' =>'form-control'])
            ->addLabelFor('contenu', 'Contenu de l\'article :')
            ->addInput('textarea', 'contenu', ['id' => 'contenu', 'class' => 'form-control'])
            ->addLabelFor('publie', 'Publie le :')
            ->addInput('date', 'publie', ['id' => 'publie', 'class' => 'form-control'])
            ->addLabelFor('user', 'Propose par :')
            ->addInput('text', 'user', ['id' => 'user', 'class' => 'form-control'])
            ->addButton('Ajouter', ['class' => 'btn btn-primary'])
            ->finForm();
    }    

}