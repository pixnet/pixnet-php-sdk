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
        $tempFolder = self::$pixapi->album->folders->create($expected_title, $expected_desc);
        $this->assertEquals($expected_title, $tempFolder['title']);
        $this->assertEquals($expected_desc, $tempFolder['description']);
        self::$pixapi->album->folders->delete($tempFolder['id']);
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
        $expected = 5;
        for ($i = 0; $i < $expected; $i++) {
            $tempFolders[] = self::$pixapi->album->folders->create($expected_title, $expected_desc);
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
        $current_set = self::$pixapi->album->folders->search('emmatest', ['folder_id' => 4948779]);
        $current_title = $current_set['title'];
        $current_desc = $current_set['description'];

        $actualset = self::$pixapi->album->folders->update(4948779, $expected_title, $expected_desc);
        $this->assertEquals($actualset['title'], $expected_title);
        $this->assertEquals($actualset['description'], $expected_desc);
        self::$pixapi->album->folders->update(4948779, $current_title, $current_desc);
    }
}
