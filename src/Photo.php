<?php


namespace App;

class Photo extends Media
{
    private string $altText;

    public function __construct(string $caption, int $width, int $height, string $altText)
    {
        $this->altText = $altText;
        parent::__construct($caption, $width, $height);
    }

    /**
     * @return string
     */
    public function getAltText(): string
    {
        return $this->altText;
    }

    /**
     * @param string $altText
     */
    public function setAltText(string $altText): void
    {
        $this->altText = $altText;
    }

    function getSummary(): string
    {
        return "<p>{$this->getCaption()} ({$this->getAltText()}) [{$this->getWidth()}x{$this->getHeight()}]</p>";
    }
}