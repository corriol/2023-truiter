<?php

use App\Helpers\FlashMessage;

require_once 'bootstrap.php';

$errors = FlashMessage::get("errors", []);

require 'views/login.view.php';
