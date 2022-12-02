<?php

use App\Registry;
use App\Services\TweetRepository;

require_once 'bootstrap.php';

try {
    $db = Registry::get(Registry::DB);
    $tweetRepository = Registry::get(TweetRepository::class);
    $tweets = $tweetRepository->findAll();

} catch (PDOException $e) {
    die($e->getLine() . ": " . $e->getMessage());
}

require 'views/index.view.php';
