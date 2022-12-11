<?php

namespace App\Controller;


use App\Core\View;
use App\Helpers\FlashMessage;
use App\Registry;
use App\Services\TweetRepository;
use App\Services\UserRepository;
use PDOException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

class DefaultController
{

    public function index(Request $request): Response
    {
        $logger = Registry::get("logger");
        $tweetRepository = Registry::get(TweetRepository::class);
        $tweets = $tweetRepository->findAll();

        $logger->info("S'ha consultat la pagina", $tweets);

        $content = View::render('index', 'default', compact('tweets'));
        return new Response($content);
    }

    public function login(Request $request): Response
    {
        $errors = FlashMessage::get("errors", []);

        $response = new Response();
        $response->setContent(View::render('login', 'default', compact('errors')));
        return $response;
    }

    public function loginProcess(Request $request): Response
    {
        $errors = [];

        $username = $request->request->get("username", "");
        $password = $request->request->get("password", "");

        $userRepository = Registry::get(UserRepository::class);

        if (empty($username) || empty($password))
            $errors[] = "Nom d'usuari o contrasenya incorrecta";

        if (empty($errors))
            try {
                $user = $userRepository->findByUsername($username);

                if (empty($user) || (!password_verify($password, $user->getPassword())))
                    $errors[] = "Nom d'usuari o contrasenya incorrecta";

            } catch (PDOException $e) {
                throw new \Exception($e->getMessage());
            }

        if (empty($errors)) {
            $_SESSION["user"] = $user;
            return new RedirectResponse("/");
        }

        $data["username"] = $username;

        FlashMessage::set("data", $data);
        FlashMessage::set("errors", $errors);

        return new RedirectResponse("/login");

    }


}