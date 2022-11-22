<?php
session_start();

require_once 'autoload.php';

try {
    $pdo = new PDO("mysql:host=mysql-server; dbname=truiter", "root", "secret");
    $stmt = $pdo->query("SELECT t.*, u.username, u.name FROM tweet t 
        INNER JOIN user u ON t.user_id = u.id 
        ORDER BY t.created_at DESC");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $stmtMedia = $pdo->prepare("SELECT * FROM media WHERE tweet_id = :tweet_id");
    $stmtMedia->setFetchMode(PDO::FETCH_ASSOC);

    // afegim els media
    while ($tweet = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stmtMedia->execute(["tweet_id" => $tweet["id"]]);
        $tweet["attachments"] = $stmtMedia->fetchAll();
        $tweets[] = $tweet;
    }


} catch (PDOException $e) {
    die($e->getLine() . ": " . $e->getMessage());
}


require 'views/index.view.php';
