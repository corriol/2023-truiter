<?php
declare(strict_types=1);

namespace App;

use InvalidArgumentException;

class Registry
{
    public const DB = 'DB';
    /**
     * this introduces global state in your application which can not be mocked up for testing
     * and is therefor considered an anti-pattern! Use dependency injection instead!
     *
     * @var []
     */

    private static array $services = [];


    private static array $allowedKeys = [
        self::DB,
        "TweetRepository"
    ];


    final public static function set(string $key, mixed $value)
    {
        if (!in_array($key, self::$allowedKeys)) {
            throw new InvalidArgumentException('Invalid key given');
        }
        self::$services[$key] = $value;
    }

    final public static function get(string $key): mixed
    {
        if (!in_array($key, self::$allowedKeys) || !isset(self::$services[$key])) {
           throw new InvalidArgumentException('Invalid key given');
        }
        return self::$services[$key];
    }

}