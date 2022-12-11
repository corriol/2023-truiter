<?php
// example.com/src/app.php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('index', new Routing\Route('/'));
$routes->add('login', new Routing\Route('/login'));
return $routes;
