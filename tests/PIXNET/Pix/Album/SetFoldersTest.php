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

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->album->setfolders->test->test();
    }

    public function testSearch()
    {
        $tmp_folder = self::$pixapi->album->folders->create('PHP-SDK unit test title', 'PHP-SDK unit test body');
        $expected = $tmp_folder['data']['id'];
        $ret = self::$pixapi->album->setfolders->search(self::$pixapi->getUserName())['data'];
        self::$pixapi->album->folders->delete($tmp_folder['data']['id']);
        foreach ($ret as $set) {
            $actual[] = $set['id'];
        }
        $this->assertTrue(in_array($expected, $actual));
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
        foreach (range(1,5) as $i) {
            $tmp_folders[] = self::$pixapi->album->folders->create('PHP-SDK unit test title', 'PHP-SDK unit test body')['data'];
        }
        foreach ($tmp_folders as $f) {
            $f_ids[] = $f['id'];
        }
        arsort($f_ids);
        $expected = implode(',', $f_ids);
        $ret = self::$pixapi->album->setfolders->position($expected)['data'];
        foreach ($ret as $set) {
            $actual[] = $set['id'];
        }
        foreach ($f_ids as $id) {
            self::$pixapi->album->folders->delete($id);
        }
        $this->assertEquals(implode(',', $actual), $expected);
    }
}
