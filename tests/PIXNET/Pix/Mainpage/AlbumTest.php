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
        $actual = self::$pixapi->mainpage->album->hot(0, array('api_version' => 2, 'count' => 10));
        $this->assertCount(10, $actual['sets']);
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::REQUIRE_PARAMETERS_MISSING
     */
    public function testHotException()
    {
        $actual = self::$pixapi->mainpage->album->hot('');
        $this->assertCount(10, $actual);
    }

    public function testLatest()
    {
        $actual = self::$pixapi->mainpage->album->latest(0, array('api_version' => 2, 'count' => 10));
        $this->assertCount(10, $actual['sets']);
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::REQUIRE_PARAMETERS_MISSING
     */
    public function testLatestException()
    {
        $actual = self::$pixapi->mainpage->album->hot('');
        $this->assertCount(10, $actual);
    }

    public function testHotWeekly()
    {
        $actual = self::$pixapi->mainpage->album->hot_weekly(0, array('api_version' => 2, 'count' => 10));
        $this->assertCount(10, $actual['sets']);
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::REQUIRE_PARAMETERS_MISSING
     */
    public function testHotWeeklyException()
    {
        $actual = self::$pixapi->mainpage->album->hot('');
        $this->assertCount(10, $actual);
    }
}
