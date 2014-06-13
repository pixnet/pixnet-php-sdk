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

    /**
     * @group gulp
     */
    public function testsearch()
    {
        // 先產生要用來測試搜尋的相簿
        for ($i = 0; $i < 5; $i++) {
            $title = $expected['title'][] = "PHP-SDK-TEST-TITLE-" . sha1($i);
            $desc = $expected['desc'][] = "PHP-SDK-TEST-DESC-" . md5($i);
            $expected['id'][] = self::$pixapi->album->sets->create($title, $desc)['id'];
        }

        $actual = self::$pixapi->Album->Sets->search('emmatest');
        foreach ($actual as $set) {
            $this->assertTrue(in_array($set['title'], $expected['title']));
        }

        unset($ret);

        foreach ($expected['id'] as $set_id) {
            $ret = self::$pixapi->album->sets->search('emmatest', ['set_id' => $set_id]);
            $this->assertEquals($set_id, $ret['id']);
            self::$pixapi->album->sets->delete($set_id);
        }
    }
}
