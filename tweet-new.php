<?php
require_once 'autoload.php';

use App\Helpers\FlashMessage;

session_start();
// ací va la lògica per crear un nou tweet

$errors = FlashMessage::get('errors', []);
$data = FlashMessage::get('data',[]);
$message = FlashMessage::get('message');


if (empty($_SESSION["user"])) {
    header('Location: login.php');
}

$user = $_SESSION["user"];

require 'views/tweet-new.view.php';