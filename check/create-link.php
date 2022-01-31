<?php
require "../bootstrap/autoload.php";
use App\Controller\LinkController;

if (isset($_POST['submit'])) {
    $link = new LinkController();
    $link->createLink();
}