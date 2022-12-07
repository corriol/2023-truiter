<?php

require_once __DIR__ . '/../bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$path = $request->getPathInfo();

$routes = [
    "/" => "index.php",
    "/login" => "login.php",
    "/login/process" => "login-process.php",
    "/tweet/new" => "tweet-new.php",
    "/tweet/new/process" => "tweet-new-process.php",
    "/logout" => "logout.php"
    ];

if (array_key_exists($path, $routes))
    require __DIR__ . "/../{$routes[$path]}";
else {
    $response = new Response("page not found!");
    $response->setStatusCode(Response::HTTP_NOT_FOUND);
    $response->prepare($request);
    $response->send();
}
