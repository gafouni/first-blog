<?php
namespace App\Forms;

use App\Entity\Post;

class UpdateForm extends Form{

/**Creation du formulaire de modification d'un article */
    public function updateForm(Post $post){


        return $this->debutForm()
        ->addLabelFor('titre', 'Titre de l\'article :')
        ->addInput('text', 'title', ['id' => 'titre', 'class' =>'form-control', 'value' =>$post->getTitle()])
        ->addLabelFor('auteur', 'Auteur :')
        ->addInput('text', 'author', ['id' => 'auteur', 'class' => 'form-control', 'value' =>$post->getAuthor()])
        ->addLabelFor('date', 'Date :')
        ->addInput('date', 'date', ['id' => 'date', 'class' =>'form-control', 'value' =>$post->getDate()])
        ->addLabelFor('contenu', 'Contenu de l\'article :')
        ->addTextarea('content', $post->getContent(), ['id' => 'contenu', 'class' => 'form-control'])
        ->addLabelFor('publie', 'Publie le :')
        ->addInput('date', 'publie', ['id' => 'publie', 'class' => 'form-control'])
        ->addLabelFor('user', 'Propose par :')
        ->addInput('text', 'user', ['id' => 'user', 'class' => 'form-control'])
        ->addButton('Ajouter', ['class' => 'btn btn-primary'])
        ->finForm();
}    

}