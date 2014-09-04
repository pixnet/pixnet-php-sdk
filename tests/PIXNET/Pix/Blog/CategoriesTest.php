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
}
