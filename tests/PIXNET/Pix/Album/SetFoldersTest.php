<?php
class Pix_Album_SetFoldersTest extends PHPUnit_Framework_TestCase
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

    public function testSearch()
    {
        $expected = ['4948779', '4948785'];
        $ret = self::$pixapi->album->setfolders->search('emmatest');
        foreach ($ret as $set) {
            $actual = $set['id'];
            $this->assertTrue(in_array($set['id'], $expected));
        }
    }
}
