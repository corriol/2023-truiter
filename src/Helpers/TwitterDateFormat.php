<?php

namespace App\Helpers;
use DateTime;

class TwitterDateFormat
{
    public DateTime $currentDateTime;
    public function __construct(DateTime $currentDateTime = new DateTime())
    {
        $this->currentDateTime = $currentDateTime;
    }

    public function format (DateTime $tweetDate) {

        $currentTimeStamp = $this->currentDateTime->getTimestamp();
        $tweetTimeStamp = $tweetDate->getTimestamp();
        $diff = $currentTimeStamp - $tweetTimeStamp;

        if ($diff < 0)
            throw new \Exception("La data no pot ser futura");


        if ($diff < 60)
            return "$diff s";

        if ($diff < 60*60)
            return  floor($diff/60) . " min";

        if ($diff < 60*60*24)
            return  floor($diff/60/60) . " h";

        return $tweetDate->format('d-m-Y');

        /*if ((int)date('m') == $mesTweet && (int)date('j') == $diaTweet && (int)date('g') > $horaTweet)
            return (int)date('g') - $horaTweet. ' h';

        if ((int)date('m') == $mesTweet && (int)date('j') > $diaTweet && (int)date('g') >= $horaTweet)
            return (int)date('g') - $horaTweet. ' h';*/
    }
}