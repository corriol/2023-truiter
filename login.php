<?php
require_once 'autoload.php';
session_start();

$errors = \App\Helpers\FlashMessage::get("errors", []);

require 'views/login.view.php';
