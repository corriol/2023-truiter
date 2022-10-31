<?php
namespace App;

use App\Exceptions\InvalidWidthMediaException;

abstract class Media
{
    private string $caption;
    private int $height;
    private int $width;

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

}