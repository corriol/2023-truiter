<?php
// src/routes.php
use Symfony\Component\Routing;

const NAME_SPACE = "App\\Controller\\";

$routes = new Routing\RouteCollection();
$routes->add('index', new Routing\Route('/',
    ['_controller'=>NAME_SPACE . 'DefaultController::index']));

$routes->add('login', new Routing\Route('/login',
    ['_controller'=>'App\Controller\DefaultController::login'], methods: ["GET"]));

$routes->add('login_process',
    new Routing\Route(
        path:'/login',
        defaults: ['_controller'=>'App\Controller\DefaultController::loginProcess'],
        methods: ["POST"]
));

$routes->add('tweet_new',
    new Routing\Route(
        path:'/tweet/new',
        defaults: ['_controller'=> NAME_SPACE . 'TweetController::create'],
        methods: ["GET"]
    ));

$routes->add('tweet_new_process',
    new Routing\Route(
        path:'/tweet/new',
        defaults: ['_controller'=> NAME_SPACE . 'TweetController::save'],
        methods: ["POST"]
    ));

$routes->add('logout',
    new Routing\Route(
        path:'/logout',
        defaults: ['_controller'=> NAME_SPACE . 'DefaultController::logout']
    ));



return $routes;
