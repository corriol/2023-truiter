<?php

use App\Core\View;
use App\Helpers\FlashMessage;

require_once 'bootstrap.php';

$errors = FlashMessage::get("errors", []);

echo View::render('login', 'default', compact('errors'));

//require 'views/login.view.php';
