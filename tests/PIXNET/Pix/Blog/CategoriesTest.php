<?php
class Pix_Blog_CategoriesTest extends PHPUnit_Framework_TestCase
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
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->blog->articles->notfound;
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSearchException()
    {
        self::$pixapi->blog->categories->search('');
    }

    public function testSearchAll()
    {
        $categories = self::$pixapi->blog->categories->search(self::$pixapi->getUserName());
        $this->assertGreaterThanOrEqual(1, $categories['total']);
    }

    public function testSearchOne()
    {
        $expected = __METHOD__ . " test";
        $tmp_category = self::$pixapi->blog->categories->create($expected);
        $categories = self::$pixapi->blog->categories->search(self::$pixapi->getUserName(), ['category_id' => $tmp_category['data']['id']]);
        self::$pixapi->blog->categories->delete($tmp_category['data']['id']);
        $this->assertEquals($expected, $categories['data']['name']);
    }

    public function testCreate()
    {
        $expected = __METHOD__ . " test";
        $tmp_category = self::$pixapi->blog->categories->create($expected);
        $actual = self::$pixapi->blog->categories->search(self::$pixapi->getUserName());
        self::$pixapi->blog->categories->delete($tmp_category['data']['id']);
        $this->assertEquals(2, $actual['total']);
    }

    public function testUpdate()
    {
        $expected = __METHOD__ . " test";
        $tmp_category = self::$pixapi->blog->categories->create($expected);
        $new_name = "test " . __METHOD__;
        self::$pixapi->blog->categories->update($tmp_category['data']['id'], $new_name);
        $actual_category = self::$pixapi->blog->categories->search(self::$pixapi->getUserName(), ['category_id' => $tmp_category['data']['id']]);
        $this->assertEquals($new_name, $actual_category['data']['name']);
        self::$pixapi->blog->categories->delete($tmp_category['data']['id']);
    }

    public function testPosition()
    {
        for ($i = 0; $i < 5; $i++) {
            $name = __METHOD__ . " test" . $i;
            $tmp_categories[$i] = self::$pixapi->blog->categories->create($name)['data'];
            $ids[] = $tmp_categories[$i]['id'];
        }
        arsort($ids);
        $i = 0;
        foreach ($ids as $id) {
            $order[$id] = $i++;
        }
        $new_position = implode(',', $ids);
        $tmp = self::$pixapi->blog->categories->position($new_position);
        $categories = self::$pixapi->blog->categories->search(self::$pixapi->getUserName())['data'];
        foreach ($tmp_categories as $cat) {
            self::$pixapi->blog->categories->delete($cat['id']);
        }
        foreach ($categories as $cat) {
            if ($cat['id'] > 0) {
                $new_order[$cat['id']] = $cat['order'];
            }
        }
        $this->assertEquals($order, $new_order);
    }
}
