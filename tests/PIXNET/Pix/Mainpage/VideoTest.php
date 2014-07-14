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
        $this->assertLessThanOrEqual(11, count($actual['elements']));
    }

    public function testLatest()
    {
        $actual = self::$pixapi->mainpage->video->latest();
        $this->assertLessThanOrEqual(11, count($actual['elements']));
    }

    public function testHotWeekly()
    {
        $actual = self::$pixapi->mainpage->video->hotWeekly();
        $this->assertLessThanOrEqual(11, count($actual['elements']));
    }
}
