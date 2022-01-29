<?php
namespace App\Model;
class DB{
    protected $pdo;
    protected $fetchMode = \PDO::FETCH_OBJ;
    public function __construct(){
        $config = require __DIR__ . "/../config.php";
        try {
            $this->pdo = new \PDO("mysql:host={$config['db']['servername']};dbname={$config['db']['dbname']}", $config['db']['username'], $config['db']['password']);
        } catch(\PDOException $e){
            die("Connection failed:" . $e->getMessage());
        }
    }
}