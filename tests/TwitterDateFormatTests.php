<?php


use App\Helpers\TwitterDateFormat;
use PHPUnit\Framework\TestCase;

class TwitterDateFormatTests extends TestCase
{

    function testClassIsInstantiable() {
        $dateFormat = new TwitterDateFormat();

        $this->assertInstanceOf(TwitterDateFormat::class, $dateFormat);
    }

    function testFormatReturnsSecondsWhenLessThanOneMinute() {

        $dateFormat = new TwitterDateFormat(new DateTime("2022-12-22 07:59:59"));

        $date = new DateTime("2022-12-22 07:59:00");
        $value = $dateFormat->format($date);

        $this->assertEquals("59 s", $value);
    }

    function testFormatReturnsSecondsWhenTheDifferenceIsOneSecond() {

        $dateFormat = new TwitterDateFormat(new DateTime("2022-12-22 08:00:02"));

        $date = new DateTime("2022-12-22 08:00:01");
        $value = $dateFormat->format($date);

        $this->assertEquals("1 s", $value);
    }

    function testFormatReturnsMinutesWhenLessThanOneHour() {

        $dateFormat = new TwitterDateFormat(new DateTime("2022-12-22 08:00:00"));

        $date = new DateTime("2022-12-22 07:59:00");
        $value = $dateFormat->format($date);

        $this->assertEquals("1 min", $value);
    }

    function testFormatReturnsHoursWhenLessThanOneDay() {

        $dateFormat = new TwitterDateFormat(new DateTime("2022-12-22 08:00:00"));

        $date = new DateTime("2022-12-22 05:01:59");
        $value = $dateFormat->format($date);

        $this->assertEquals("2 h", $value);
    }

    function testFormatReturnsDateFormWhenMoreThanOneDay() {

        $dateFormat = new TwitterDateFormat(new DateTime("2022-12-22 08:00:00"));

        $date = new DateTime("2022-12-20 07:01:59");
        $value = $dateFormat->format($date);

        $this->assertEquals("20-12-2022", $value);
    }

    function testRaiseAnExceptionWhenIsAFutureDate() {

        $this->expectException(Exception::class);

        $dateFormat = new TwitterDateFormat(new DateTime("2022-12-22 08:00:00"));

        $date = new DateTime("2022-12-23 10:01:59");
        $value = $dateFormat->format($date);
    }

    /**
    * @dataProvider getDates();
    */

    function testValues(string $currentDate, string $tweetDate, string $result) {

        $dateFormat = new TwitterDateFormat(new DateTime($currentDate));

        $date = new DateTime($tweetDate);
        $value = $dateFormat->format($date);

        $this->assertEquals($value, $result);
    }

    public function getDates(): array {
        return [
            ["2022-12-20 10:00:00", "2022-12-20 08:00:00", "2 h"],
            ["2022-12-20 10:00:00", "2022-12-20 09:00:00", "1 h"],
            ["2022-12-20 10:00:00", "2022-12-20 09:59:00", "1 min"],
            ["2022-12-20 10:00:00", "2022-12-20 09:59:50", "10 s"],
        ];
    }
}
