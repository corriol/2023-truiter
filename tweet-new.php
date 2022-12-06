<?php
require_once 'bootstrap.php';

use App\Core\View;
use App\Helpers\FlashMessage;

$errors = FlashMessage::get('errors', []);
$data = FlashMessage::get('data',[]);
$message = FlashMessage::get('message');

// comprovant si l'usuari ha iniciat sessió
$user = $_SESSION["user"] ?? null;

if (empty($user)) {
    header('Location: login.php');
    exit();
}

echo View::render('tweet-new', 'default', compact('errors', 'data', 'message', 'user'));