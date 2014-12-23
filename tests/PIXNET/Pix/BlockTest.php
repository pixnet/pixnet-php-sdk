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
        $actual = $actual_all['data']['user']['name'];

        $this->assertEquals('emma', $actual);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        $actual = self::$pixapi->block->create('');
    }

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->block->test->test();
    }

    /**
     * @depends testCreate
     */
    public function testSearch()
    {
        $actual_all = self::$pixapi->block->search()['data'];
        $actual = $actual_all[0]['user']['name'];
        $expected = 'emma';

        $this->assertEquals($expected, $actual);
    }

    /**
     * @depends testSearch
     */
    public function testDelete()
    {
        $actual = self::$pixapi->block->delete('emma');
        $this->assertEquals($actual['error'], 0);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->block->delete('');
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->block->notfound;
    }
}
