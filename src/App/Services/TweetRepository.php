<?php

namespace App\Services;

use App\Photo;
use App\Registry;
use App\Tweet;
use App\User;
use DateTime;

class TweetRepository
{
    private DB $db;

    public function __construct()
    {
        $this->db = Registry::get(Registry::DB);
    }

    public function findAll(): array
    {
        $tweets = [];

        $stmt = $this->db->run("SELECT t.*, u.username, u.name FROM tweet t 
        INNER JOIN user u ON t.user_id = u.id 
        ORDER BY t.created_at DESC");

        // afegim els media
        while ($tweet = $stmt->fetch()) {

            $stmtUser = $this->db->run("SELECT * FROM user WHERE id = :id",
                ["id" => $tweet["user_id"]]);

            $user = $stmtUser->fetch();
            $userObj = new User($user["name"], $user["username"]);

            $tweetObj = new Tweet($tweet["text"], $userObj);
            $tweetObj->setCreatedAt(DateTime::createFromFormat("Y-m-d h:i:s", $tweet["created_at"]));
            $tweetObj->setLikeCount($tweet["like_count"]);

            $stmtMedia = $this->db->run("SELECT * FROM media WHERE tweet_id = :tweet_id",
                ["tweet_id" => $tweet["id"]]);

            while ($media = $stmtMedia->fetch()) {
                $mediaObj = new Photo($media["alt_text"], $media["width"],
                    $media["height"], $media["alt_text"]);
                $tweetObj->addAttachment($mediaObj);
            }
            $tweets[] = $tweetObj;
        }
        return $tweets;
    }
}