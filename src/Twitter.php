<?php

namespace App;

class Twitter
{
    private array $tweets;
    private array $users;

    private int $numberOfUsers;
    private int $numberOfTweets;

    public function __construct()
    {
        $this->numberOfTweets = 0;
        $this->numberOfUsers = 0;
    }

    /**
     * @return array
     */
    public function getTweets(): array
    {
        return $this->tweets;
    }

    /**
     * @param array $tweets
     */
    public function setTweets(array $tweets): void
    {
        $this->tweets = $tweets;
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param array $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }

    /**
     * @return int
     */
    public function getNumberOfUsers(): int
    {
        return $this->numberOfUsers;
    }

    /**
     * @param int $numberOfUsers
     */
    public function setNumberOfUsers(int $numberOfUsers): void
    {
        $this->numberOfUsers = $numberOfUsers;
    }

    /**
     * @return int
     */
    public function getNumberOfTweets(): int
    {
        return $this->numberOfTweets;
    }

    /**
     * @param int $numberOfTweets
     */
    public function setNumberOfTweets(int $numberOfTweets): void
    {
        $this->numberOfTweets = $numberOfTweets;
    }


    public function addUser(User $user): void
    {
        $this->numberOfUsers++;
        $this->users[] = $user;
    }

    public function addTweet(Tweet $tweet): void
    {
        $this->numberOfTweets++;
        $this->tweets[] = $tweet;
    }

    public function LikeTweet(User $user, Tweet $tweet): void
    {
        $tweet->setLikeCount($tweet->getLikeCount() + 1);
    }
}