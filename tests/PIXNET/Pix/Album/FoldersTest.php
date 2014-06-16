<?php
class Pix_FoldersTest extends PHPUnit_Framework_TestCase
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
        $expected = '4948779';
        $ret = self::$pixapi->album->folders->search('emmatest');
        $actual = $ret[0]['id'];
        $this->assertEquals($expected, $actual);

        $ret = self::$pixapi->album->folders->search('emmatest', ['folder_id' => '4948779']);
        $actual = $ret['id'];
        $this->assertEquals($expected, $actual);
    }

    public function testCreate()
    {
        $expected_title = 'PIXNET_SDK_TITLE';
        $expected_desc = 'PIXNET_SDK_DESC';
        $tempFolder = self::$pixapi->album->folders->create($expected_title, $expected_desc);
        $this->assertEquals($expected_title, $tempFolder['title']);
        $this->assertEquals($expected_desc, $tempFolder['description']);
        self::$pixapi->album->folders->delete($tempFolder['id']);
    }
}
