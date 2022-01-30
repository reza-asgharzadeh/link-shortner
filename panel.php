<?php
use App\Controller\LinkController;
    require "bootstrap/autoload.php";
    $sessionEmail = $_SESSION['email'];
    $sessionId = $_SESSION['id'];
    $links = new LinkController();
    $links = $links->getLinks($sessionId);
?>
<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="public/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="public/css/fonts.css">

    <title>پنل مدیریت لینک</title>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between mt-3">
        <div><h4 class="mb-5 text-center text-muted">پنل ایجاد و مدیریت لینک</h4></div>
        <div>ایمیل شما: <?=$sessionEmail?></div>
        <div><a href="check/destroy.php" class="btn btn-sm btn-danger px-3">خروج</a></div>
    </div>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">شناسه</th>
                <th scope="col">لینک اصلی</th>
                <th scope="col">لینک کوتاه</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($links as $link){?>
                    <tr>
                        <th scope="row"><?= $link['id'] ?></th>
                        <td><?= $link['original_link'] ?></td>
                        <td><a href="<?= $link['original_link'] ?>" target="_blank"><?= $link['short_link'] ?></a></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="check/edit.php?id=<?= $link['id'] ?>">ویرایش</a>
                            <a class="btn btn-sm btn-danger" href="check/delete.php?id=<?= $link['id'] ?>">حذف</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="col-md-6">
            <form action="panel.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="original_link" placeholder="لینک اصلی را وارد کنید ..." required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">ایجاد لینک کوتاه</button>
            </form>
        </div>
    </div>
</div>
<script src="public/js/bootstrap.bundle.min.js"></script>
<?php
if(isset($_POST['submit'])){
    $link = new LinkController();
    $link->createLink();
}
?>
</body>
</html>