<?php
class Pix_IndexTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;


    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    public static function tearDownAfterClass()
    {
        Authentication::tearDownAfterClass();
    }

    public function testRate()
    {
        $actual = self::$pixapi->index->rate();

        $expected = [
           'rate' => 0,
           'authenticated' => true,
           'limit' => 6000,
           'error' => 0
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testNow()
    {
        if (function_exists("date_default_timezone_set")) {
            date_default_timezone_set("Asia/Taipei");
        }
        $actual = self::$pixapi->index->now();

        var_dump(time());
        var_dump($actual);
        $expected = (5 >= abs($actual - time())) ? true : false;

        $this->assertEquals(time(), $actual);
    }
}
