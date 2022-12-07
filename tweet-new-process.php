<?php
declare(strict_types=1);
require_once 'bootstrap.php';

use App\Helpers\Exceptions\NoUploadedFileException;
use App\Helpers\Exceptions\UploadedFileException;
use App\Helpers\FlashMessage;
use App\Helpers\UploadedFileHandler;
use App\Helpers\Validator;
use App\Photo;
use App\Registry;
use App\Services\PhotoRepository;
use App\Services\TweetRepository;
use App\Services\UserRepository;
use App\Tweet;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;


// comprovant si l'usuari ha iniciat sessió
$user = $_SESSION["user"] ?? null;

if (empty($user)) {
    $response = new RedirectResponse('login.php');
    $response->send();
}

$request = Request::createFromGlobals();

const UPLOAD_PATH = "uploads";
const MAX_SIZE = 1024 * 1024 * 3;

$errors = [];
$data = [];

$userRepository = Registry::get(UserRepository::class);
$tweetRepository = Registry::get(TweetRepository::class);
$photoRepository = Registry::get(PhotoRepository::class);


$newFilename = "";
$text = $request->request->get('text', '');
$text = filter_var($text, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
    } catch (NoUploadedFileException $e) {
    } catch (UploadedFileException $e) {
        $errors[] = $e->getMessage();
    } catch (Exception $exception) {
        $errors[] = "Error general:" . $exception->getMessage();
    }
}

if (!empty($errors)) {
    FlashMessage::set('errors', $errors);
    FlashMessage::set('data', $data);
    $response = new RedirectResponse("tweet-new.php");
    $response->send();
}
try {

    $tweet = new Tweet($data["text"], $user);
    $tweet->setCreatedAt(new DateTime());
    $tweet->setLikeCount(0);

    $tweetRepository->save($tweet);

    if (!empty($newFilename)) {
        try {
            list($width, $height) = getimagesize(UPLOAD_PATH . "/" . $newFilename);
            $photo = new Photo($newFilename, $width, $height, $newFilename);
            $photo->setUrl($newFilename);
            $photo->setTweet($tweet);
            $tweet->addAttachment($photo);
            $photoRepository->save($photo);
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }
} catch (PDOException $e) {
    $errors[] = $e->getMessage();
}

if (!empty($errors)) {
    FlashMessage::set("errors", $errors);
    $response = new RedirectResponse("tweet-new.php");
    $response->send();
}

$_SESSION["data"] = $data;
$response = new RedirectResponse("index.php");
$response->send();
