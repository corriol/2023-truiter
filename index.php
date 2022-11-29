<?php

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


require 'views/index.view.php';
