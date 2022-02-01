<?php
require "../bootstrap/autoload.php";
session_destroy();
header("Location: /link/login.php");