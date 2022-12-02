<?php
declare(strict_types=1);
session_start();
require_once 'vendor/autoload.php';

use App\Registry;
use App\Services\DB;
use App\Services\PhotoRepository;
use App\Services\TweetRepository;
use App\Services\UserRepository;
use Monolog\Handler\ChromePHPHandler;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$db = new DB("truiter", "root", "secret", "mysql-server");
Registry::set(Registry::DB, $db);

// create a log channel
$log = new Logger('App');
$log->pushHandler(new StreamHandler('var/app.log', Level::Debug));
// $log->pushHandler(new ChromePHPHandler(Level::Debug));
Registry::set("logger", $log);

$tweetRepository = new TweetRepository();
Registry::set(TweetRepository::class, $tweetRepository);

$userRepository = new UserRepository();
Registry::set(UserRepository::class, $userRepository);

$photoRepository = new PhotoRepository();
Registry::set(PhotoRepository::class, $photoRepository);
