<?php
require_once 'bootstrap.php';

use App\Registry;
use App\Services\UserRepository;
use App\User;
use App\Helpers\FlashMessage;

$errors = [];

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password");

$userRepository = Registry::get(UserRepository::class);


if (empty($username) || empty($password))
    $errors[] = "Nom d'usuari o contrasenya incorrecta";


if (empty($errors))
    try {

        $user = $userRepository->findByUsername($username);

        if (empty($user) || (!password_verify($password, $user->getPassword())))
            $errors[] = "Nom d'usuari o contrasenya incorrecta";
    } catch (PDOException $e) {
        die($e->getMessage());
    }

if (empty($errors)) {
    $_SESSION["user"] = $user;
    header('Location: /');
    exit();
}

$data["username"] = $username;

FlashMessage::set("data", $data);
FlashMessage::set("errors", $errors);

header('Location: /login');
exit();
