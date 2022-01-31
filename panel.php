<?php
require "bootstrap/autoload.php";
use App\Controller\LinkController;
if (isset($_SESSION['email'])) {
    $sessionEmail = $_SESSION['email'];
    $sessionId = $_SESSION['id'];
    $links = new LinkController();
    $links = $links->getLinks($sessionId);
} else {
    header("Location: login.php");
}
?>
<?php include "view/header.php"?>
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
            <form action="check/create-link.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" dir="ltr" name="original_link" placeholder="example.com/url-short-test-aparat-active-link" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">ایجاد لینک کوتاه</button>
            </form>
        </div>
    </div>
</div>
<script src="public/js/bootstrap.bundle.min.js"></script>
</body>
</html>