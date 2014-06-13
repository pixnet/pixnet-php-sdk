<?php
class Pix_Album_SetsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    public function setUp()
    {
        echo "\033[1;32m" . $this->getName() . " \033[34mFinished.\033[0m" . PHP_EOL;
    }

    public static function tearDownAfterClass()
    {
        Authentication::tearDownAfterClass();
    }

    public function testcreate()
    {
        for ($i = 0; $i < 5; $i++) {
            $title = "PHP-SDK-TEST-TITLE-" . sha1($i);
            $desc = "PHP-SDK-TEST-DESC-" . md5($i);
            $ret = self::$pixapi->album->sets->create($title, $desc);
            $this->assertEquals($title, $ret['title']);
            $this->assertEquals($desc, $ret['description']);
            self::$pixapi->album->sets->delete($ret['id']);
        }
    }

    public function testsearch()
    {
        $this->markTestIncomplete('先從 create 開始測');
        $actual = self::$pixapi->Album->Sets->search('emmatest');
        $ret = self::$pixapi->query('album/sets', ['user' => 'emmatest'], 'GET');
        $expected = $ret['sets'];
        var_dump($ret);
        var_dump($actual);
        $this->assertEquals($expected, $actual);

        $sets = $expected;
        foreach ($sets as $set) {
            $ret = self::$pixapi->query('album/sets/' . $set['id']);
            $expected = $ret['set'];
            $actual = self::$pixapi->Album->Sets->search('emmatest', ['set_id' => $set['id']]);
            $this->assertEquals($expected, $actual);

        }
    }
}
