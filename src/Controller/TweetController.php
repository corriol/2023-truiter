<?php

namespace App\Controller;

use App\Core\View;
use App\Helpers\Exceptions\NoUploadedFileException;
use App\Helpers\Exceptions\UploadedFileException;
use App\Helpers\FlashMessage;
use App\Helpers\TwitterDateFormat;
use App\Helpers\UploadedFileHandler;
use App\Helpers\Validator;
use App\Photo;
use App\Registry;
use App\Services\PhotoRepository;
use App\Services\TweetRepository;
use App\Services\UserRepository;
use App\Tweet;
use App\Validator\NewTweetRequestValidator;
use DateTime;
use Exception;
use InvalidArgumentException;
use PDOException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TweetController
{

    const UPLOAD_PATH = __DIR__ . "/../../public/uploads";
    const MAX_SIZE = 1024 * 1024 * 3;

    public function create(Request $request): Response
    {
        $errors = FlashMessage::get('errors', []);
        $data = FlashMessage::get('data', []);
        $message = FlashMessage::get('message');



        // comprovant si l'usuari ha iniciat sessió
        $user = $_SESSION["user"] ?? null;

        if (empty($user))
            return new RedirectResponse('/login');

        $content = View::render('tweet-new', 'default', compact('user', 'errors', 'data', 'message'));
        return new Response($content);

    }

    public function save(Request $request): Response
    {
        // comprovant si l'usuari ha iniciat sessió
        $user = $_SESSION["user"] ?? null;

        if (empty($user))
            return new RedirectResponse('/login');

        $errors = [];
        $data = [];

        $userRepository = Registry::get(UserRepository::class);
        $tweetRepository = Registry::get(TweetRepository::class);
        $photoRepository = Registry::get(PhotoRepository::class);

        $newFilename = "";

        $validator = new NewTweetRequestValidator();
        list($data, $errors) = $validator->validate($request);

        $validTypes = ["image/jpeg", "image/jpg", "image/png"];

        if (empty($errors)) {
            try {
                $uploadedFile = new UploadedFileHandler($_FILES["file"], $validTypes, self::MAX_SIZE);
                $newFilename = $uploadedFile->handle(self::UPLOAD_PATH);
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
            return new RedirectResponse("/tweet/new");
        }

        try {

            $tweet = new Tweet($data["text"], $user);
            $tweet->setCreatedAt(new DateTime());
            $tweet->setLikeCount(0);

            $tweetRepository->save($tweet);

            if (!empty($newFilename)) {
                try {
                    list($width, $height) = getimagesize(self::UPLOAD_PATH . "/" . $newFilename);
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
            return new RedirectResponse("/tweet/new");

        }
        return new RedirectResponse("/");
    }

}