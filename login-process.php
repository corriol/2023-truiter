<?php
require_once 'autoload.php';

session_start();

use App\User;
use App\Helpers\FlashMessage;


$errors = [];

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password");


if (empty($username) || empty($password))
    $errors[] = "Nom d'usuari o contrasenya incorrecta";


if (empty($errors))
try {
    $pdo = new PDO("mysql:host=mysql-server; dbname=truiter", "root", "secret");
    $stmt = $pdo->prepare("SELECT * FROM user u WHERE u.username = :username");
    $stmt->bindValue("username", $username);
    $stmt->execute();
    $user = $stmt->fetch();

    if (empty($user) || (!password_verify($password,  $user["password"])))
        $errors[] = "Nom d'usuari o contrasenya incorrecta";
}
catch (PDOException $e) {
    die($e-> getMessage ());
}

if (empty($errors)) {
    $_SESSION["user"] = $user;
    header('Location: index.php');
    exit();
}

$data["username"] = $username;

FlashMessage::set("data", $data);
FlashMessage::set("errors", $errors);

header('Location: login.php');
exit();
