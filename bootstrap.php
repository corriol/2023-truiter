<?php
declare(strict_types=1);
session_start();
require_once 'autoload.php';

use App\Registry;
use App\Services\DB;
use App\Services\TweetRepository;

$db = new DB("truiter", "root", "secret", "mysql-server");
Registry::set(Registry::DB, $db);

$tweetRepository = new TweetRepository();
Registry::set("TweetRepository", $tweetRepository);
