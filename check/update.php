<?php
require "../bootstrap/autoload.php";
use App\Controller\LinkController;
if (isset($_POST['submit'])){
    $links = new LinkController();
    $links->update($_POST['original_link'],$_SESSION['link_id'],$_SESSION['id']);
}