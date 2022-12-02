<?php
require_once 'bootstrap.php';

use App\Helpers\FlashMessage;

$errors = FlashMessage::get('errors', []);
$data = FlashMessage::get('data',[]);
$message = FlashMessage::get('message');


if (empty($_SESSION["user"])) {
    header('Location: login.php');
}

$user = $_SESSION["user"] ?? null;

if (empty($user)) {
    header('Location: login.php');
    exit();
}

require 'views/tweet-new.view.php';