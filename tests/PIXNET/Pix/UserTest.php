<?php
class Pix_UserTest extends PHPUnit_Framework_TestCase
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

    public function testInfo()
    {
        $actual = self::$pixapi->user->info()['data'];
        $this->assertTrue('' != $actual['name']);
    }

    public function testInfoQuery()
    {
        $actual = self::$pixapi->user->info(self::$pixapi->getUserName())['data'];
        $this->assertEquals(self::$pixapi->getUserName(), $actual['name']);
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->user->notfound;
    }

    public function testIsVip()
    {
        $this->assertEquals(1, self::$pixapi->user->isVip(false));
        $this->assertEquals(1, self::$pixapi->user->isVip());
    }
}
