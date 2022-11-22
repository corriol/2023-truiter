<?php
require_once 'autoload.php';
session_start();

$errors = $_SESSION["errors"] ?? [];
unset($_SESSION["errors"]);

require 'views/login.view.php';
