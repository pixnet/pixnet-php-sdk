<?php
class PixAPITest extends PHPUnit_Framework_TestCase
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
        $actual = self::$pixapi;
        $this->assertEquals('Pix_Index', get_class($actual->index));
        $this->assertEquals('Pix_User', get_class($actual->user));
        $this->assertEquals('Pix_Blog', get_class($actual->blog));
        $this->assertEquals('Pix_Album', get_class($actual->album));
        $this->assertEquals('Pix_Friend', get_class($actual->friend));
        $this->assertEquals('Pix_Guestbook', get_class($actual->guestbook));
        $this->assertEquals('Pix_Block', get_class($actual->block));
        $this->assertEquals('Pix_Mainpage', get_class($actual->mainpage));
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->xxx;
    }
}
