<?php include "view/header.php"?>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto my-5">
            <h4 class="mb-5 text-center">صفحه ثبت نام در پنل</h4>
            <form action="register.php" method="post">
                <label for="fullname" class="form-label">نام کامل</label>
                <div class="mb-3">
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="مثال: رضا" required>
                </div>
                <label for="email" class="form-label">آدرس ایمیل</label>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="مثال: reza@gmail.com" required>
                </div>
                <?php
                if( !empty( $_REQUEST['FailedMessage'] ) )
                {
                    echo sprintf( '<p class="text-danger fw-bold">%s</p>', $_REQUEST['FailedMessage'] );
                }
                ?>
                <label for="password" class="form-label">رمز عبور</label>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="مثال: 123456" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary px-4">ثبت نام</button>
                <br><br>
                <a href="/link/login.php">صفحه ورود</a>
            </form>
        </div>
    </div>
</div>
<script src="public/js/bootstrap.bundle.min.js"></script>
<?php
    if(isset($_POST['submit'])){
        require "bootstrap/autoload.php";
        $name = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $users = new \App\Controller\UserController();
        $users->register($name,$email,$password);
    }
?>
</body>
</html>