<?php
// src/routes.php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('index', new Routing\Route('/',
    ['_controller'=>'App\Controller\DefaultController::index']));

$routes->add('login', new Routing\Route('/login',
    ['_controller'=>'App\Controller\DefaultController::login'], methods: ["GET"]));

$routes->add('login_process',
    new Routing\Route(
        path:'/login',
        defaults: ['_controller'=>'App\Controller\DefaultController::loginProcess'],
        methods: ["POST"]
));

return $routes;
