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

    public function testSearch()
    {
        $categories = self::$pixapi->blog->categories->search(self::$pixapi->getUserName());
        $this->assertGreaterThanOrEqual(1, $categories['total']);
    }

    public function testCreate()
    {
        $expected = __METHOD__ . " test";
        $tmp_category = self::$pixapi->blog->categories->create($expected);
        $actual = self::$pixapi->blog->categories->search(self::$pixapi->getUserName());
        self::$pixapi->blog->categories->delete($tmp_category['data']['id']);
        $this->assertEquals(2, $actual['total']);
    }
}
