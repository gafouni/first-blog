<?php

namespace App\Validation;

class Validator {

    //Les donnees qui vont etre entrees par les utilisateurs ($_POST)
    private $data;
    private $errors;

    public function __construct(array $data){

        $this ->data = $data;
    }

    public function validate(array $rules): ?array{

        foreach ($rules as $name => $rulesarray) {
            if (array_key_exists($name, $this->data)) {
                foreach ($rulesarray as $rule) {
                    switch ($rule) {
                        case 'required' :
                            $this->required($name, $this->data[$name]);
                            break;
                        case substr($rule, 0, 3) === 'min':
                            $this->min($name, $this->data[$name], $rule);
                            break;
                        default:

                        break;

                    }
                }
            }
        }

        return $this->getErrors();
    }


    private function required(string $name, string $value){

        $value = trim($value);
        
        if (!isset($value) || ($value === NULL) || empty($value)){
            $this->errors[$name][] = "{$name} est requis.";
        }
    }


    private function min(string $name, string $value, string $rule){

        preg_match_all('/(\d+)/', $rule, $matches);
        $limit = (int) $matches[0][0];

        if (strlen($value) < $limit){
            $this->errors[$name][] = "{$name} doit comprendre un minimum de {$limit} caracteres";
        }

    }


    private function getErrors(): ?array{

        return $this->errors;
    }

}
