<?php
require "bootstrap/autoload.php";
use App\Controller\User;
$user = new User();
$user->getUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/link-shortner/register.php" method="post" required>
        <input type="text" name="fullname" placeholder="fullname" required><br>
        <input type="email" name="email" placeholder="email" required><br>
        <input type="password" name="password" placeholder="password" required><br><br>
        <button>submit</button>
    </form>
</body>
</html>