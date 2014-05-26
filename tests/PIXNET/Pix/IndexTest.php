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
        $actual = self::$pixapi->index->now();

        $expected = (5 >= abs($actual - time())) ? true : false;

        $this->assertTrue($expected);
    }
}
