<?php
require "../bootstrap/autoload.php";
use App\Controller\LinkController;
if (isset($_SESSION['email'])) {
    $links = new LinkController();
    $link = $links->edit($_GET['id'], $_SESSION['id']);
    $_SESSION['link_id'] = $link['id'];
} else {
    header("Location: /link/login.php");
}
?>
<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../public/css/fonts.css">

    <title>ویرایش لینک</title>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between mt-3">
        <div><h4 class="mb-5 text-center text-muted">ویرایش لینک</h4></div>
        <div>ایمیل شما: <?php echo $_SESSION['email']?></div>
        <div><a href="../check/destroy.php" class="btn btn-sm btn-danger px-3">خروج</a></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form action="update.php" method="post">
                <div class="mb-4">
                    <label for="original_link" class="form-label text-secondary">ویرایش لینک اصلی به صورت دستی</label>
                    <input type="text" class="form-control" id="original_link" dir="ltr" name="original_link" value="<?=$link['original_link']?>" placeholder="ویرایش لینک اصلی">
                </div>
                <div class="mb-4">
                    <label for="short_link" class="form-label text-secondary">ویرایش لینک کوتاه به صورت اتوماتیک</label>
                    <input type="text" class="form-control" id="short_link" dir="ltr" name="short_link" value="<?=$link['short_link']?>" disabled>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">ویرایش لینک</button>
                <a class="btn btn-danger" href="/link/panel.php">انصراف</a>
            </form>
        </div>
    </div>
</div>
<script src="../public/js/bootstrap.bundle.min.js"></script>
</body>
</html>