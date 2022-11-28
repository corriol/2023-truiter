<?php
namespace App;

use App\Exceptions\InvalidWidthMediaException;

abstract class Media
{
    private int $id;
    private string $caption; // alt_text -> varchar(255);
    private int $height;
    private int $width;
    private string $url; //varchar(255)
    private Tweet $tweet;

    public function __construct(string $caption, int $width, int $height)
    {
        $this->caption = $caption;
        $this->height = $height;

        if($width<300)
            throw new InvalidWidthMediaException();

        $this->width = $width;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     */
    public function setCaption(string $caption): void
    {
        $this->caption = $caption;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    abstract function getSummary(): string;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return Tweet
     */
    public function getTweet(): Tweet
    {
        return $this->tweet;
    }

    /**
     * @param Tweet $tweet
     */
    public function setTweet(Tweet $tweet): void
    {
        $this->tweet = $tweet;
    }

}