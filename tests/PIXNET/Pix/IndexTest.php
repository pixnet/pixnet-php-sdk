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

        // 誤差在10秒內都算可接受的範圍
        $expected = abs($actual - time());

        $this->assertLessThanOrEqual(10, $expected);
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->index->xxx;
    }
}
