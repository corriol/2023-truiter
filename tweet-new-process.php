<?php
declare(strict_types=1);
session_start();

const UPLOAD_PATH = "uploads";
const MAX_SIZE = 1024 * 1024 * 3;

$errors = [];
$data = [];

$newFilename = "";

$text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!empty($text) && strlen($text) > 1 && strlen($text) <= 280)
    $data["text"] = $text;
else
    $errors[] = "El text enviat és incorrecte";

$validTypes = ["image/jpeg", "image/jpg", "image/png"];

if (empty($errors)) {
    try {
        if (!empty($_FILES['file']) && ($_FILES['file']['error'] == UPLOAD_ERR_OK)) {
            if (!file_exists(UPLOAD_PATH))
                mkdir(UPLOAD_PATH, 0777, true);

            $tempFilename = $_FILES["file"]["tmp_name"];
            $currentFilename = $_FILES["file"]["name"];

            $mimeType = $_FILES["file"]["type"];

            $extension = explode("/", $mimeType)[1];
            $newFilename = md5((string)rand()) . "." . $extension;
            $newFullFilename = UPLOAD_PATH . "/" . $newFilename;
            $fileSize = $_FILES["file"]["size"];

            if (!in_array($mimeType, $validTypes))
                throw new Exception("La foto no és jpg");

            if ($fileSize > MAX_SIZE)
                throw new Exception("La foto té $fileSize bytes");
            var_dump($tempFilename, $newFullFilename);
            if (!move_uploaded_file($tempFilename, $newFullFilename))
                throw new Exception("No s'ha pogut moure la foto");


        } else
            throw new Exception("Cal pujar una photo");
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
}

if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    $_SESSION["data"] = $data;

    /*    FlashMessage::set('errors', $errors);
        FlashMessage::set('data', $data);*/
    header('Location:tweet-new.php');
    exit();
} else {

    try {
        $pdo = new PDO("mysql:host=mysql-server; dbname=truiter", "root", "secret");
        $stmt = $pdo->prepare("INSERT INTO tweet (text, user_id, created_at, like_count) VALUES (:text, :user_id, :created_at, :like_count)");

        $data["user_id"] = $_SESSION["user"]["id"];
        $data["created_at"] = date("Y-m-d h:i:s");
        $data["like_count"] = 0;

        $stmt->execute($data);
        $id = $pdo->lastInsertId();

        if (!empty($newFilename)) {
            try {
                list($width, $height) = getimagesize($newFullFilename);
                $stmt = $pdo->prepare("INSERT INTO media (alt_text, width, height, tweet_id, url) VALUES (:alt_text, :width, :height, :tweet_id, :url)");
                $stmt->bindValue("alt_text", $newFilename);
                $stmt->bindValue("width", $width);
                $stmt->bindValue("height", $height);
                $stmt->bindValue("tweet_id", $id);
                $stmt->bindValue("url", $newFilename);
                var_dump($stmt);
                $stmt->execute();

            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $_SESSION["data"] = $data;
    header('Location:index.php');
    exit();
}