<?php
require "../bootstrap/autoload.php";
use App\Controller\LinkController;

$links = new LinkController();
$links->delete($_GET['id'], $_SESSION['id']);