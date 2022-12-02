<?php


use App\Helpers\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    function testLengthBetweenRaiseException() {
        $this->expectException(InvalidArgumentException::class);
        Validator::lengthBetween("12", 3, 5);
    }

    function testLengthBetweenRaiseException2() {
        $this->expectException(InvalidArgumentException::class);
        Validator::lengthBetween("12456", 3, 5);
    }

    function testLengthBetweenWorksProperly() {
        Validator::lengthBetween("123", 3, 5);
        $this->addToAssertionCount(1);
    }

    function testLengthBetweenWorksProperly2() {
        Validator::lengthBetween("12345", 3, 5);
        $this->addToAssertionCount(1);
    }

    /**
     * @dataProvider getLengthBetweenData();
     * @param $args
     * @param $success
     * @return void
     */
    function testLengthBetween(array $args, bool $success): void
    {

        if (!$success)
            $this->expectException(InvalidArgumentException::class);

        Validator::lengthBetween($args[0], $args[1], $args[2]);
        $this->addToAssertionCount(1);
    }

    public function getLengthBetweenData(): array
    {
        return [
            [["12", 3, 5], false],
            [["12456", 3, 5], false],
            [["123", 3, 5], true],
            [["12345", 3, 5], true],
        ];
    }
}
