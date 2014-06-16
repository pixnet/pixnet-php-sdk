<?php
class Pix_Album_SetsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    /**
     * 產生測試用的相簿
     */
    private function createTempSets()
    {
        for ($i = 0; $i < 5; $i++) {
            $title = "PHP-SDK-TEST-TITLE-" . sha1($i);
            $desc = "PHP-SDK-TEST-DESC-" . md5($i);
            $expected[] = self::$pixapi->album->sets->create($title, $desc);
        }
        return $expected;
    }

    /**
     * 刪除測試用的相簿
     */
    private function destoryTempSets($sets)
    {
        foreach ($sets as $set) {
            self::$pixapi->album->sets->delete($set['id']);
        }
    }

    public static function tearDownAfterClass()
    {
        Authentication::tearDownAfterClass();
    }

    public function testCreate()
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

    public function testPosition()
    {
        $current_albumsets = self::$pixapi->Album->sets->search('emmatest', ['parent_id' => 4948779]);
        $num_of_sets = count($current_albumsets);
        $i = 1;
        foreach ($current_albumsets as $set) {
            $new_order[$i++%$num_of_sets] = $set['id'];
        }
        ksort($new_order);
        $expected = $new_order;
        $ret_albumsets = self::$pixapi->Album->sets->position('4948779', implode(',', $new_order));
        foreach ($ret_albumsets as $set) {
            $actual[] = $set['id'];
        }
        $this->assertEquals($actual, $expected);
    }
    public function testSearch()
    {

        $tempSets = $this->createTempSets();
        foreach ($tempSets as $set) {
            $expected['title'][] = $set['title'];
            $expected['id'][] = $set['id'];
        }
        $actual = self::$pixapi->Album->Sets->search('emmatest');
        foreach ($actual as $set) {
            $this->assertTrue(in_array($set['title'], $expected['title']));
        }

        foreach ($expected['id'] as $set_id) {
            $ret = self::$pixapi->album->sets->search('emmatest', ['set_id' => $set_id]);
            $this->assertEquals($set_id, $ret['id']);
        }

        $this->destoryTempSets($tempSets);
    }

    public function testElements()
    {
        // 以此相簿為測試範本 http://emmatest.pixnet.net/album/set/4948710
        $expected = ['167691000', '167691006'];
        $current_elements = self::$pixapi->album->sets->elements('emmatest', 4948710);
        foreach ($current_elements as $ele) {
            $actual[] = $ele['id'];
        }
        $this->assertEquals($actual, $expected);
    }

    public function testComments()
    {
        // 以此相簿為測試範本 http://emmatest.pixnet.net/album/set/4948710
        $expected = ['1095963', '1095966'];
        $current_albumcomments = self::$pixapi->album->sets->comments('emmatest', 4948710);
        foreach ($current_albumcomments as $comm) {
            $actual[] = $comm['id'];
        }
        $this->assertEquals($actual, $expected);
    }

    public function testUpdate()
    {
        $expected_title = "unit test title";
        $expected_desc = "unit test description";
        $current_set = self::$pixapi->album->sets->search('emmatest', ['set_id' => 4948710]);
        $current_title = $current_set['title'];
        $current_desc = $current_set['description'];

        $actualset = self::$pixapi->album->sets->update(4948710, $expected_title, $expected_desc);
        $this->assertEquals($actualset['title'], $expected_title);
        $this->assertEquals($actualset['description'], $expected_desc);
        self::$pixapi->album->sets->update(4948710, $current_title, $current_desc);
    }

    public function testDelete()
    {
        $tempSets = $this->createTempSets();
        $expected = count($tempSets);
        $actual = 0;
        foreach ($tempSets as $set) {
            $ret = self::$pixapi->album->sets->delete($set['id']);
            if(!$ret['error']) {
                $actual++;
            }
        }
        $this->assertEquals($actual, $expected);
    }

    public function testNearby()
    {
        $expected = ['34260'];
        $options = array('distance_max' => 3500);
        $ret = self::$pixapi->album->sets->nearby(emmademo, '25.058172', '121.535304', $options);
        foreach ($ret as $set) {
            $this->assertTrue(in_array($set['id'], $expected));
        }
    }
}
