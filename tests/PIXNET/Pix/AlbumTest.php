<?php
class Pix_AlbumTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;


    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    public function setUp()
    {
    }

    public static function tearDownAfterClass()
    {
        Authentication::tearDownAfterClass();
    }

    public function testSiteCategories()
    {
        $actual = self::$pixapi->album->siteCategories();
        $ret = self::$pixapi->query('album/site_categories');
        $expected = $ret['categories'];
        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->album->notfound;
    }
}
