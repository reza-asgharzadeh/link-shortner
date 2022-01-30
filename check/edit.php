<?php
require "../bootstrap/autoload.php";
use App\Controller\LinkController;
    $links = new LinkController();
    $link = $links->edit($_GET['id'],$_SESSION['id']);
    $_SESSION['link_id'] = $link['id'];
?>
<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="public/css/fonts.css">

    <title>ویرایش لینک</title>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between mt-3">
        <div><h4 class="mb-5 text-center text-muted">پنل ویرایش لینک</h4></div>
        <div>ایمیل شما: <?php echo $_SESSION['email']?></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form action="update.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="original_link" value="<?=$link['original_link']?>" placeholder="لینک اصلی را وارد کنید ...">
                    <input type="text" class="form-control" name="short_link" value="<?=$link['short_link']?>" disabled>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">ویرایش لینک</button>
            </form>
        </div>
    </div>
</div>
<script src="../public/js/bootstrap.bundle.min.js"></script>
</body>
</html>