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
           'error' => 0,
           'http_code' => 200
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testNow()
    {
        if (function_exists("date_default_timezone_set")) {
            date_default_timezone_set("Asia/Taipei");
        }
        $actual = self::$pixapi->index->now();

        // 誤差在30秒內都算可接受的範圍
        $expected = abs($actual - time());

        $this->assertLessThanOrEqual(30, $expected);
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->index->notfound;
    }
}
