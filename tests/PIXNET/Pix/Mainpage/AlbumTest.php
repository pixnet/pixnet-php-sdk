<?php
class Pix_Mainpage_AlbumTest extends PHPUnit_Framework_TestCase
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

    public function testColumns()
    {
        $actual = self::$pixapi->mainpage->album->columns(array('api_version' => 2));
        $this->assertCount(6, $actual);
    }

    public function testHot()
    {
        $actual = self::$pixapi->mainpage->album->hot(0);
        $this->assertCount(10, $actual);
    }

    public function testLatest()
    {
        $actual = self::$pixapi->mainpage->album->latest(0);
        $this->assertCount(10, $actual);
    }

    public function testHotWeekly()
    {
        $actual = self::$pixapi->mainpage->album->hot_weekly(0);
        $this->assertCount(10, $actual);
    }
}
