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

    function save(Tweet $tweet)
    {
        $data["text"] = $tweet->getText();
        $data["user_id"] = $tweet->getAuthor()->getId();
        $data["created_at"] = $tweet->getCreatedAt()->format("Y-m-d h:i:s");
        $data["like_count"] = $tweet->getLikeCount();

        $sql ="INSERT INTO tweet (text, user_id, created_at, like_count) VALUES (:text, :user_id, :created_at, :like_count)";
        $stmt = $this->db->run($sql, $data);

        $id = $this->db->getPDO()->lastInsertId();
        $tweet->setId($id);
    }

}