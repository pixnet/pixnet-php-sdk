<?php
class Pix_Block_Test extends PHPUnit_Framework_TestCase
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

    public function testCreate()
    {
        $actual_all = self::$pixapi->block->create('emma');
        $actual = $actual_all['block']['user']['name'];

        $this->assertEquals('emma', $actual);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        $actual = self::$pixapi->block->create('');
    }

    public function testSearch()
    {
        $actual_all = self::$pixapi->block->search();
        $actual = $actual_all[0]['user']['name'];
        $expected = 'emma';

        $this->assertEquals($expected, $actual);
    }

    public function testDelete()
    {
        self::$pixapi->block->delete('emma');
        $actual = self::$pixapi->block->search();

        $this->assertFalse($actual);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->block->delete('');
    }
}
