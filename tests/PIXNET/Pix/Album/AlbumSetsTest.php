<?php
class Pix_Album_SetsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $fixture_pics = ['350x200-emmatest.png', '350x250-emmatest.png', '400x500-emmatest.png', '550x200-emmatest.png'];

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    /**
     * 產生測試用的相片
     */
    private function createTempElements($set)
    {
        foreach (self::$fixture_pics as $filename) {
            $path = __DIR__ . '/../../../fixture/';
            $tempElements[] = self::$pixapi->album->elements->create($set['id'], $path . $filename, ['title' => $filename])['data'];
        }
        return $tempElements;
    }

    /**
     * 產生測試用的相簿
     */
    private function createTempSets($options = ['parent_id' => 0])
    {
        $title = "PHP-SDK-TEST-TITLE-" . sha1(time());
        $desc = "PHP-SDK-TEST-DESC-" . md5(time());
        return self::$pixapi->album->sets->create($title, $desc, $options)['data'];
    }

    /**
     * 刪除測試用的相簿
     */
    private function destroyTempSets($sets)
    {
        foreach ($sets as $set) {
            self::$pixapi->album->sets->delete($set['id']);
        }
    }

    public static function tearDownAfterClass()
    {
        Authentication::tearDownAfterClass();
    }

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->album->sets->test->test();
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        self::$pixapi->album->sets->create('', '');
    }

    public function testCreate()
    {
        for ($i = 0; $i < 5; $i++) {
            $title = "PHP-SDK-TEST-TITLE-" . sha1($i);
            $desc = "PHP-SDK-TEST-DESC-" . md5($i);
            $ret = self::$pixapi->album->sets->create($title, $desc)['data'];
            $this->assertEquals($title, $ret['title']);
            $this->assertEquals($desc, $ret['description']);
            self::$pixapi->album->sets->delete($ret['id']);
        }
    }

    /**
     * @expectedException PixAPIException
     */
    public function testPositionException()
    {
        self::$pixapi->Album->sets->position('', '');
    }

    public function testPosition()
    {
        $tmpFolder = self::$pixapi->Album->folders->create('unit test folder', 'unit test unit test')['data'];
        for ($i = 0; $i < 5; $i++) {
            $temp_sets[] = $this->createTempSets(['parent_id' => $tmpFolder['id']]);
        }
        $current_albumsets = self::$pixapi->Album->sets->search(self::$pixapi->getUserName(), ['parent_id' => $tmpFolder['id']])['data'];
        $num_of_sets = count($current_albumsets);
        $i = 1;
        foreach ($current_albumsets as $set) {
            $new_order[$i++ % $num_of_sets] = $set['id'];
        }
        ksort($new_order);
        $expected = $new_order;
        $ret_albumsets = self::$pixapi->Album->sets->position($tmpFolder['id'], implode(',', $new_order))['data'];
        $this->destroyTempSets($temp_sets);
        self::$pixapi->Album->folders->delete($tmpFolder['id']);
        foreach ($ret_albumsets as $set) {
            $actual[] = $set['id'];
        }
        $this->assertEquals($actual, $expected);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSearchException()
    {
        self::$pixapi->Album->Sets->search('');
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSearchTwoParamsException()
    {
        self::$pixapi->Album->Sets->search('', '');
    }

    public function testSearch()
    {

        for ($i = 0; $i < 5; $i++) {
            $tempSets[] = $this->createTempSets();
        }
        foreach ($tempSets as $set) {
            $expected['title'][] = $set['title'];
            $expected['id'][] = $set['id'];
        }
        $current = self::$pixapi->Album->Sets->search(self::$pixapi->getUserName())['data'];
        foreach ($current as $set) {
            $actual[] = $set['title'];
        }
        foreach ($expected['title'] as $set) {
            $this->assertTrue(in_array($set, $actual));
        }

        foreach ($expected['id'] as $set_id) {
            $ret = self::$pixapi->album->sets->search(self::$pixapi->getUserName(), ['set_id' => $set_id])['data'];
            $this->assertEquals($set_id, $ret['id']);
        }

        $this->destroyTempSets($tempSets);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testElementsException()
    {
        self::$pixapi->album->sets->elements('', '');
    }

    public function testElements()
    {
        $temp_set = $this->createTempSets();
        $temp_elements = $this->createTempElements($temp_set);
        $current_elements = self::$pixapi->album->sets->elements(self::$pixapi->getUserName(), $temp_set['id'])['data'];
        $this->destroyTempSets([$temp_set]);
        foreach ($temp_elements as $ele) {
            $expected[] = $ele['id'];
        }
        foreach ($current_elements as $ele) {
            $actual[] = $ele['id'];
        }
        $this->assertEquals($actual, $expected);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCommentsException()
    {
        self::$pixapi->album->sets->comments('', '');
    }

    public function testComments()
    {
        $temp_set = $this->createTempSets(['cancomment' => 1, 'parent_id' => 0]);
        $comment = self::$pixapi->Album->comments->create(self::$pixapi->getUserName(), $temp_set['id'], 'test message')['data'];
        $current_albumcomments = self::$pixapi->album->sets->comments(self::$pixapi->getUserName(), $temp_set['id'])['data'][0];
        $this->destroyTempSets([$temp_set]);
        $this->assertEquals($current_albumcomments['id'], $comment['id']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testUpdateException()
    {
        self::$pixapi->album->sets->update('', '', '');
    }

    public function testUpdate()
    {
        $temp_set = $this->createTempSets();
        $expected_title = "unit test title";
        $expected_desc = "unit test description";
        $current_set = self::$pixapi->album->sets->search(self::$pixapi->getUserName(), ['set_id' => $temp_set['id']])['data'];
        $current_title = $current_set['title'];
        $current_desc = $current_set['description'];

        $actualset = self::$pixapi->album->sets->update($temp_set['id'], $expected_title, $expected_desc)['data'];
        $this->destroyTempSets([$temp_set]);
        $this->assertEquals($actualset['title'], $expected_title);
        $this->assertEquals($actualset['description'], $expected_desc);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        self::$pixapi->album->sets->delete('');
    }

    public function testDelete()
    {
        for ($i = 0; $i < 5; $i++) {
            $tempSets[] = $this->createTempSets();
        }
        $expected = count($tempSets);
        $actual = 0;
        foreach ($tempSets as $set) {
            $ret = self::$pixapi->album->sets->delete($set['id']);
            if (!$ret['error']) {
                $actual++;
            }
        }
        $this->assertEquals($actual, $expected);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testNearbyException()
    {
        $ret = self::$pixapi->album->sets->nearby('', '', '');
    }

    public function testNearby()
    {
        $expected = ['34260'];
        $options = array('distance_max' => 3500);
        $ret = self::$pixapi->album->sets->nearby('emmademo', '25.058172', '121.535304', $options)['data'];
        foreach ($ret as $set) {
            $this->assertTrue(in_array($set['id'], $expected));
        }
    }
}
