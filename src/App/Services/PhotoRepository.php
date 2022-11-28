<?php

namespace App\Services;

use App\Photo;
use App\Registry;
use App\Tweet;
use App\User;
use DateTime;

class PhotoRepository
{
    private DB $db;

    public function __construct()
    {
        $this->db = Registry::get(Registry::DB);
    }


    function save(Photo $photo)
    {

        $data["alt_text"] = $photo->getAltText();
        $data["width"] = $photo->getWidth();
        $data["height"] = $photo->getHeight();
        $data["url"] = $photo->getUrl();
        $data["tweet_id"] = $photo->getTweet()->getId();

        $sql = "INSERT INTO media (alt_text, width, height, tweet_id, url) VALUES (:alt_text, :width, :height, :tweet_id, :url)";
        $this->db->run($sql, $data);
    }

}