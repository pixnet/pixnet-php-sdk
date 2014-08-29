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

    /**
     * @expectedException PixAPIException
     */
    public function testSearchException()
    {
        self::$pixapi->album->folders->search('');
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSearchTwoParamException()
    {
        self::$pixapi->album->folders->search('', '');
    }

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->album->folders->test->test();
    }

    public function testSearch()
    {
        $tmp_folder = self::$pixapi->album->folders->create('PHP-SDK unit test title', 'PHP-SDK unit test body');
        $expected = $tmp_folder['data']['id'];
        $ret = self::$pixapi->album->folders->search(self::$pixapi->getUserName())['data'];
        $actual = $ret[0]['id'];
        $this->assertEquals($expected, $actual);

        $ret = self::$pixapi->album->folders->search(self::$pixapi->getUserName(), ['folder_id' => $expected])['data'];
        $actual = $ret['id'];
        $this->assertEquals($expected, $actual);
        self::$pixapi->album->folders->delete($tmp_folder['data']['id']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        self::$pixapi->album->folders->create('', '');
    }

    public function testCreate()
    {
        $expected_title = 'PIXNET_SDK_TITLE';
        $expected_desc = 'PIXNET_SDK_DESC';
        $tempFolder = self::$pixapi->album->folders->create($expected_title, $expected_desc)['data'];
        self::$pixapi->album->folders->delete($tempFolder['id']);
        $this->assertEquals($expected_title, $tempFolder['title']);
        $this->assertEquals($expected_desc, $tempFolder['description']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        self::$pixapi->album->folders->delete('');
    }

    public function testDelete()
    {
        $expected_title = 'PIXNET_SDK_TITLE';
        $expected_desc = 'PIXNET_SDK_DESC';
        $expected = 1;
        for ($i = 0; $i < $expected; $i++) {
            $tempFolders[] = self::$pixapi->album->folders->create($expected_title, $expected_desc)['data'];
        }
        $actual = 0;
        foreach ($tempFolders as $folder) {
            $ret = self::$pixapi->album->folders->delete($folder['id']);
            if (!$ret['error']) {
                $actual++;
            }
        }
        $this->assertEquals($actual, $expected);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testUpdateException()
    {
        self::$pixapi->album->folders->update('', '', '');
    }

    public function testUpdate()
    {
        $expected_title = "unit test title";
        $expected_desc = "unit test description";
        $tmp_folder = self::$pixapi->album->folders->create($expected_title, $expected_desc)['data'];
        $expected_title .= "TEST";
        $expected_desc .= "TEST";

        $actualset = self::$pixapi->album->folders->update($tmp_folder['id'], $expected_title, $expected_desc)['data'];
        $this->assertEquals($actualset['title'], $expected_title);
        $this->assertEquals($actualset['description'], $expected_desc);
        self::$pixapi->album->folders->delete($tmp_folder['id']);
    }
}
