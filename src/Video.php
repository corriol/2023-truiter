<?php

namespace App;

class Video extends Media
{
    private int $duration;

    public function __construct(string $caption, int $width, int $height, int $duration)
    {
        parent::__construct($caption, $width, $height);

        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    function getSummary(): string
    {
        return "<p>{$this->getCaption()} [{$this->getWidth()}x{$this->getHeight()}] ( {$this->getDuration() } s)</p>";
    }
}