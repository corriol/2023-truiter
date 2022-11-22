<?php
session_start();
// ací va la lògica per crear un nou tweet
/*
$errors = FlashMessage::get('errors', []);
$data = FlashMessage::get('data',[]);
$message = FlassMessage::get('message');*/

$errors = $_SESSION["errors"] ?? [];
unset($_SESSION["errors"]);


$data = $_SESSION["data"] ?? [];
unset($_SESSION["data"]);

if (empty($_SESSION["user"])) {
    header('Location: login.php');
}

$user = $_SESSION["user"];

require 'views/tweet-new.view.php';