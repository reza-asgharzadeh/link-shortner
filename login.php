<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="public/css/fonts.css">

    <title>صفحه ورود</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto my-5">
            <h4 class="mb-5 text-center">صفحه ورود به پنل</h4>
            <?php
            if( !empty( $_REQUEST['SuccessMessage'] ) )
            {
                echo sprintf( '<p class="text-success fw-bold">%s</p>', $_REQUEST['SuccessMessage'] );
            }
            ?>
            <form action="login.php" method="post">
                <label for="email" class="form-label">ایمیل</label>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <label for="password" class="form-label">رمز عبور</label>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <?php
                if( !empty( $_REQUEST['FailedMessage'] ) )
                {
                    echo sprintf( '<p class="text-danger fw-bold">%s</p>', $_REQUEST['FailedMessage'] );
                }
                ?>
                <button type="submit" name="submit" class="btn btn-success px-4">ورود</button>
                <br><br>
                <a href="/link/register.php">ثبت نام نکرده اید؟ اینجا کلیک کنید</a>
            </form>
        </div>
    </div>
</div>
<script src="public/js/bootstrap.bundle.min.js"></script>
<?php
if(isset($_POST['submit'])){
    require "bootstrap/autoload.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $users = new \App\Controller\UserController();
    $users->login($email,$password);
}
?>
</body>
</html>