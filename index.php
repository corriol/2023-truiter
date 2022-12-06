<?php

use App\Core\View;
use App\Registry;
use App\Services\TweetRepository;

require_once 'bootstrap.php';

try {
    $db = Registry::get(Registry::DB);
    $logger = Registry::get("logger");
    $tweetRepository = Registry::get(TweetRepository::class);
    $tweets = $tweetRepository->findAll();

    $logger->info("S'ha consultat la pagina", $tweets );

} catch (PDOException $e) {
    die($e->getLine() . ": " . $e->getMessage());
}

echo View::render('index', 'default', compact('tweets'));
//require 'views/index.view.php';
