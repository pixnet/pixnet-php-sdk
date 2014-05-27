<?php
class Pix_Mainpage_VideoTest extends PHPUnit_Framework_TestCase
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

    public function testHot()
    {
        $actual = self::$pixapi->mainpage->video->hot();
        $this->assertCount(10, $actual['elements']);
    }

    public function testLatest()
    {
        $actual = self::$pixapi->mainpage->video->latest();
        $this->assertCount(10, $actual['elements']);
    }

    public function testHotWeekly()
    {
        $actual = self::$pixapi->mainpage->video->hot_weekly();
        $this->assertCount(10, $actual['elements']);
    }
}
