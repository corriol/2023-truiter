<?php
require_once 'bootstrap.php';

use App\Helpers\FlashMessage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$errors = FlashMessage::get('errors', []);
$data = FlashMessage::get('data',[]);
$message = FlashMessage::get('message');

// comprovant si l'usuari ha iniciat sessió
$user = $_SESSION["user"] ?? null;

if (empty($user)) {
    $response = new RedirectResponse('login.php');
    $response->send();
}

$request = Request::createFromGlobals();
// creem la resposta
$response = new Response();

// redirigim l'eixida estàndard a memòria (buffer).
ob_start();
require 'views/tweet-new.view.php';
$content = ob_get_clean();


// la variable $content contindrà tot l'HTML generat per la vista.
$response->setContent($content);

$response->setStatusCode(200);
$response->headers->set('Content-Type', 'text/html');

// el mètode prepare assegura que la resposta compleix l'especificació HTTP.
$response->prepare($request);

$response->send();
