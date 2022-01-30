<?php
namespace App\Controller;
use App\Model\DB;

class UserController extends DB{
    public function register($name,$email,$password)
    {
        $sql = "INSERT INTO users (name,email,password) VALUES (?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name,$email,$password]);

        $SuccessMessage = "شما با موفقیت ثبت نام کرده اید لطفا وارد شوید...";
        header("Location:login.php?SuccessMessage={$SuccessMessage}");
    }

    public function login($email,$password)
    {
        $sql = "SELECT * FROM users where email=? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $record = $stmt->fetch();

        if($record == null){
            $FailedMessage = "ایمیل یا رمز عبور شما اشتباه است...";
            header("Location:login.php?Message={$FailedMessage}");
        } else {
            if($record['password'] == $password){
                $_SESSION['id'] = $record['id'];
                $_SESSION['email'] = $record['email'];
                header('Location: panel.php');
            } else {
                $FailedMessage = "ایمیل یا رمز عبور شما اشتباه است...";
                header("Location:login.php?FailedMessage={$FailedMessage}");
            }
        }
    }
}