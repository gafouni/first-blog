<?php
namespace App\Forms;

class Form {

    protected $formCode ='';

    /**Methode qui servira a generer (creer) le formulaire html */
    public function createForm()
    {
        return $this->formCode;
    }

    /**Ici, on peut faire une methode de validation des donnees du formulaire (facultatif) */

    /**Methode qui permet d'ajouter a un tableau des attributs envoyes a la balise 'input'(id, required etc)*/

    protected function addAttributes(array $attributes): string
    {
        //On initialise une chaine de caracteres
        $str = '';

        //On liste les attributs "courts" et on retourne une string avec le nom de ces attributs
        $courts = ['checked', 'disables', 'readonly', 'multiple', 'required', 'autofocus', 
        'novalidate', 'formnovalidate'];

        foreach($attributes as $attribute => $valeur){
            if(in_array($attribute, $courts) && $valeur == true){
                $str .= " $attribute";
            }else{
                $str .= " $attribute='$valeur'";
            }
        }
        return $str;
    }

        /**Methode: balise d'ouverture du formulaire */
    public function debutForm(string $methode = 'post', string $action = '#',
    array $attributes = []): self{
        $this->formCode .= "<form action='$action' method='$methode'";
        $this->formCode .=$attributes ? $this->addAttributes($attributes).'>' : '>';

        return $this;
    }

    /**Balise de fermeture */
    public function finForm():self{
        $this->formCode .= '</form>';
        return $this;
    }

    /**Methode: ajout d'un label */
    public function addLabelFor(string $for, string $texte, array $attributes =[]):self{
        $this->formCode .= "<label for='$for'";
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';
        $this->formCode .= ">$texte</label>";

        return $this;
    }

    /**Methode: ajout d'un champ input */
    public function addInput(string $type, string $nom, array $attributes = []):self{
        $this->formCode .= "<input type='$type' name='$nom'";
        $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

        return $this;
    }

    /**Ajout d'un champ textarea */
    public function addTextarea(string $nom, string $valeur = '', array $attributes = []):self{
        $this->formCode .= "<textarea name='$nom'";
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';
        $this->formCode .= ">$valeur</textarea>";

        return $this;
    }    

    /**Ajout d'un champ Select, liste deroulante */
    public function addSelect(string $nom, array $options, array $attributes = []):self{
        $this->formCode .= "<select name='$nom'";
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';
        foreach($options as $valeur =>$texte){
            $this->formCode .= "<option value='$valeur'>$texte</option>";
        }
        $this->formCode .= ">$valeur</select>";
    
        return $this;    
    }    

    /**Methode: ajouter un bouton */
    public function addButton(string $texte, array $attributes = []):self{
        $this->formCode .= '<button ';
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';
        $this->formCode .= ">$texte</button>";
    
        return $this;
    }    

}
