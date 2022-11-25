<?php

use App\Registry;

require_once 'bootstrap.php';

try {
    $db = Registry::get(Registry::DB);
    $tweetRepository = Registry::get("TweetRepository");
    $tweets = $tweetRepository->findAll();

} catch (PDOException $e) {
    die($e->getLine() . ": " . $e->getMessage());
}


require 'views/index.view.php';
