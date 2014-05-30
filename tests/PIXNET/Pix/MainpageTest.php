<?php
class Pix_MainpageTest extends PHPUnit_Framework_TestCase
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

    public function testSubClassIsExist()
    {
        $actual = self::$pixapi->mainpage;
        $this->assertEquals('Pix_Mainpage_Blog', get_class($actual->blog));
        $this->assertEquals('Pix_Mainpage_Album', get_class($actual->album));
        $this->assertEquals('Pix_Mainpage_Video', get_class($actual->video));
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->mainpage->xxx;
    }
}
