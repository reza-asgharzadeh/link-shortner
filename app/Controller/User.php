<?php
namespace App\Controller;
use App\Model\DB;
class User extends DB{
    public function getUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll($this->fetchMode);
    }
}