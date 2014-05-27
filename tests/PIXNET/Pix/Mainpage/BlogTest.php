<?php
class Pix_Mainpage_BlogTest extends PHPUnit_Framework_TestCase
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
        $actual = self::$pixapi->mainpage->blog->columns();
        $this->assertCount(6, $actual);
    }

    public function testHot()
    {
        $actual = self::$pixapi->mainpage->blog->hot(0);
        $this->assertCount(10, $actual);
    }

    public function testLatest()
    {
        $actual = self::$pixapi->mainpage->blog->latest(0);
        $this->assertCount(10, $actual);
    }

    public function testHotWeekly()
    {
        $actual = self::$pixapi->mainpage->blog->hot_weekly(0);
        $this->assertCount(10, $actual);
    }
}
