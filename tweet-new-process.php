<?php
declare(strict_types=1);
require_once 'autoload.php';

use App\Helpers\Exceptions\NoUploadedFileException;
use App\Helpers\Exceptions\UploadedFileException;
use App\Helpers\FlashMessage;
use App\Helpers\UploadedFileHandler;
use App\Helpers\Validator;

session_start();

const UPLOAD_PATH = "uploads";
const MAX_SIZE = 1024 * 1024 * 3;

$errors = [];
$data = [];

$newFilename = "";
$text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

try {
    Validator::lengthBetween($text, 2, 280);
    $data["text"] = $text;
} catch (InvalidArgumentException $e) {
    $errors[] = $e->getMessage();
}

$validTypes = ["image/jpeg", "image/jpg", "image/png"];

if (empty($errors)) {

    try {
        $uploadedFile = new UploadedFileHandler($_FILES["file"], $validTypes, MAX_SIZE);
        $newFilename = $uploadedFile->handle(UPLOAD_PATH);
    }
    catch (NoUploadedFileException $e) {
    }
    catch (UploadedFileException $e) {
        $errors[] = $e->getMessage();
    }
    catch (Exception $exception) {
        $errors[] = "Error general:" . $exception->getMessage();
    }
}

if (!empty($errors)) {
    FlashMessage::set('errors', $errors);
    FlashMessage::set('data', $data);
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
                list($width, $height) = getimagesize(UPLOAD_PATH . "/" . $newFilename);
                $stmt = $pdo->prepare("INSERT INTO media (alt_text, width, height, tweet_id, url) VALUES (:alt_text, :width, :height, :tweet_id, :url)");
                $stmt->bindValue("alt_text", $newFilename);
                $stmt->bindValue("width", $width);
                $stmt->bindValue("height", $height);
                $stmt->bindValue("tweet_id", $id);
                $stmt->bindValue("url", $newFilename);
              //  var_dump($stmt);
                $stmt->execute();

            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    if (!empty($errors)) {
        FlashMessage::set("errors", $errors);
        header('Location:tweet-new.php');
        exit();
    }

    $_SESSION["data"] = $data;
    header('Location:index.php');
    exit();
}