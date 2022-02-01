<?php
namespace App\Model;
class DB{
    protected $connect;
    public function __construct(){
        $config = require __DIR__ . "/../config.php";
        try {
            $this->connect = new \PDO("mysql:host={$config['db']['servername']};dbname={$config['db']['dbname']}", $config['db']['username'], $config['db']['password']);
        } catch(\PDOException $e){
            die("Connection failed:" . $e->getMessage());
        }
    }
}