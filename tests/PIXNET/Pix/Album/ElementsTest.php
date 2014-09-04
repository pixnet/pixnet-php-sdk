<?php
class Pix_Album_ElementsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $tempSet;
    public static $tempElements;
    public static $fixture_pics = ['350x200-emmatest.png', '350x250-emmatest.png', '400x500-emmatest.png', '550x200-emmatest.png'];

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->album->elements->test->test();
    }

    private function createTempSet()
    {
        self::$tempSet = self::$pixapi->album->sets->create('emmatest title', 'emmatest description');
    }

    private function destroyTempSet()
    {
        $ret = self::$pixapi->album->sets->delete(self::$tempSet['data']['id']);
    }

    private function createTempElements()
    {
        foreach (self::$fixture_pics as $filename) {
            $filename = __DIR__ . '/../../../fixture/' . $filename;
            self::$tempElements[] = self::$pixapi->album->elements->create(self::$tempSet['data']['id'], $filename);
        }
    }

    public function testCreate()
    {
        $this->createTempSet();
        foreach (self::$fixture_pics as $filename) {
            $filename = __DIR__ . '/../../../fixture/' . $filename;
            $element = self::$pixapi->album->elements->create(self::$tempSet['data']['id'], $filename);
            $this->assertEquals($element['error'], 0);
        }
        $this->destroyTempSet();
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        $element = self::$pixapi->album->elements->create('', '');
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSearchException()
    {
        $element = self::$pixapi->album->elements->search('');
    }
}
