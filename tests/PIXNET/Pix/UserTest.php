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
        $actual = self::$pixapi->user->info('emmatest');
        $this->assertEquals('emmatest', $actual['name']);
    }
}
