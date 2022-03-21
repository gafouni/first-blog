<?php
namespace App\Repository;

class CoreRepository
{
    protected \PDO $pdo; 
    public function __construct(){
        $this->pdo = new \PDO('mysql:host=localhost;dbname=firstblog;charset=utf8', 'root', '');
 
    }
}
