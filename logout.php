<?php
require_once 'bootstrap.php';

session_unset();
session_destroy();

header('Location: index.php');
exit();
