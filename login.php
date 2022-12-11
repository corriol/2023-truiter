<?php

use App\Core\View;
use App\Helpers\FlashMessage;
use Symfony\Component\HttpFoundation\Response;

require_once 'bootstrap.php';

$errors = FlashMessage::get("errors", []);

$response = new Response();
$response->setContent(View::render('login', 'default', compact('errors')));

//require 'views/login.view.php';
