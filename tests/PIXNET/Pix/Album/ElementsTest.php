<?php
class Pix_Album_ElementsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $fixture_pics = ['350x200-emmatest.png', '350x250-emmatest.png', '400x500-emmatest.png', '550x200-emmatest.png'];

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    /**
     * @expectedException PixAPIException
     */
    public function testGetException()
    {
        self::$pixapi->album->elements->test->test();
    }

    private function createTempSet()
    {
        return self::$pixapi->album->sets->create('emmatest title', 'emmatest description');
    }

    private function destroyTempSet($set)
    {
        self::$pixapi->album->sets->delete($set['data']['id']);
    }

    private function createTempElements($set)
    {
        foreach (self::$fixture_pics as $filename) {
            $filename = __DIR__ . '/../../../fixture/' . $filename;
            $tempElements[] = self::$pixapi->album->elements->create($set['data']['id'], $filename);
        }
        return $tempElements;
    }

    public function testCreate()
    {
        $tempSet = $this->createTempSet();
        foreach (self::$fixture_pics as $filename) {
            $filename = __DIR__ . '/../../../fixture/' . $filename;
            $element = self::$pixapi->album->elements->create($tempSet['data']['id'], $filename);
            $this->assertEquals($element['error'], 0);
        }
        $this->destroyTempSet($tempSet);
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

    public function testSearchBySet()
    {
        $tempSet = $this->createTempSet();
        $this->createTempElements($tempSet);
        $elements = self::$pixapi->album->elements->search(self::$pixapi->getUserName(), ['set_id' => $tempSet['data']['id']]);
        $this->destroyTempSet($tempSet);
        $this->assertEquals(4, $elements['total']);
    }

    public function testSearchByElement()
    {
        $tempSet = $this->createTempSet();
        $tempElements = $this->createTempElements($tempSet);
        foreach ($tempElements as $ele) {
            $elements = self::$pixapi->album->elements->search(self::$pixapi->getUserName(), ['element_id' => $ele['data']['id']]);
            $this->assertEquals($ele['total'], $elements['total']);
        }
        $this->destroyTempSet($tempSet);
    }

    public function testUpdate()
    {
        $tempSet = $this->createTempSet();
        $tempElements = $this->createTempElements($tempSet);
        foreach ($tempElements as $ele) {
            $new_title = __METHOD__ . " " . time();
            self::$pixapi->album->elements->update($ele['data']['id'], ['title' => $new_title]);
            $elements = self::$pixapi->album->elements->search(self::$pixapi->getUserName(), ['element_id' => $ele['data']['id']]);
            $this->assertEquals($new_title, $elements['data']['title']);
        }
        $this->destroyTempSet($tempSet);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testUpdateException()
    {
        self::$pixapi->album->elements->update('', []);
    }

    public function testDelete()
    {
        $tempSet = $this->createTempSet();
        $tempElements = $this->createTempElements($tempSet);
        foreach ($tempElements as $ele) {
            $ret = self::$pixapi->album->elements->delete($ele['data']['id']);
            $this->assertEquals(0, $ret['error']);
        }
        $this->destroyTempSet($tempSet);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        self::$pixapi->album->elements->delete('');
    }

    public function testPosition()
    {
        $tempSet = $this->createTempSet();
        $tempElements = $this->createTempElements($tempSet);
        foreach ($tempElements as $ele) {
            $id[] = $ele['data']['id'];
        }
        arsort($id);
        $ids = implode(',', $id);
        $ret = self::$pixapi->album->elements->position($tempSet['data']['id'], $ids);
        $actual = self::$pixapi->album->elements->search(self::$pixapi->getUserName(), ['set_id' => $tempSet['data']['id']]);
        foreach ($actual['data'] as $ele) {
            $new_order[$ele['id']] = $ele['position'];
        }
        $i = 0;
        foreach ($actual['data'] as $ele) {
            $this->assertEquals($new_order[$ele['id']], $i++);
        }
        $this->destroyTempSet($tempSet);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testPositionException()
    {
        self::$pixapi->album->elements->position('', '');
    }

    public function testNearby()
    {
        $tempSet = $this->createTempSet();
        $tempElements = $this->createTempElements($tempSet);
        foreach ($tempElements as $ele) {
            $lat = 25.058173;
            $lon = 121.535304;
            self::$pixapi->album->elements->update($ele['data']['id'], ['latitude' => $lat, 'longitude' => $lon]);
        }
        $elements = self::$pixapi->album->elements->nearby(self::$pixapi->getUserName(), 25.058172, 121.535304, ['distance_max' => 50000]);
        $this->assertEquals(4, $elements['total']);
        $this->destroyTempSet($tempSet);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testNearbyException()
    {
        self::$pixapi->album->elements->nearby('', 25.058172, 121.535304, ['distance_max' => 50000]);
    }
}
