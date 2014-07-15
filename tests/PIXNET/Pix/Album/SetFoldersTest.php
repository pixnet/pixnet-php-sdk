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

    /**
     * @expectedException PixAPIException
     */
    public function testSearchException()
    {
        self::$pixapi->album->setfolders->search('');
    }

    public function testSearch()
    {
        $expected = ['4948779', '4948785'];
        $ret = self::$pixapi->album->setfolders->search('emmatest')['data'];
        foreach ($ret as $set) {
            $this->assertTrue(in_array($set['id'], $expected));
        }
    }

    /**
     * @expectedException PixAPIException
     */
    public function testPositionException()
    {
        self::$pixapi->album->setfolders->position('');
    }

    public function testPosition()
    {
        $expected = '4948785,4948779';
        $ret = self::$pixapi->album->setfolders->position($expected)['data'];
        foreach ($ret as $set) {
            $actual[] = $set['id'];
        }
        $actual = implode(',', $actual);
        $this->assertEquals($actual, $expected);
        $expected = '4948779,4948785';
        $ret = self::$pixapi->album->setfolders->position($expected);
    }
}
