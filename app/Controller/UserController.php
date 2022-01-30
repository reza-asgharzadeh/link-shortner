<?php
namespace App\Controller;
use App\Model\DB;

class UserController extends DB{
    public function register($name,$email,$password)
    {
        $sql = "SELECT * FROM users where email=? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $record = $stmt->fetch();

        //Check if the email exist
        if ($record){
            $FailedMessage = "با این ایمیل قبلا ثبت نام کرده اید...";
            header("Location:register.php?FailedMessage={$FailedMessage}");
        }

        //register user with OOP and PDO
        $sql = "INSERT INTO users (name,email,password) VALUES (?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$name,$email,$password]);

        $SuccessMessage = "شما با موفقیت ثبت نام کرده اید لطفا وارد شوید...";
        header("Location:login.php?SuccessMessage={$SuccessMessage}");
    }

    public function login($email,$password)
    {
        //login user with OOP and PDO
        $sql = "SELECT * FROM users where email=? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $record = $stmt->fetch();

        //Check if the email Doesn't exist
        if(!$record){
            $FailedMessage = "ایمیل یا رمز عبور شما اشتباه است...";
            header("Location:login.php?FailedMessage={$FailedMessage}");
        }

        //Check if the Form Password doesn't Equal in the Database Record Password
        if($record['password'] != $password){
            $FailedMessage = "ایمیل یا رمز عبور شما اشتباه است...";
            header("Location:login.php?FailedMessage={$FailedMessage}");
        }

        //if the email exist and password correct redirect to panel.php
        if($record['password'] == $password){
            $_SESSION['id'] = $record['id'];
            $_SESSION['email'] = $record['email'];
            header('Location: panel.php');
        }
    }
}