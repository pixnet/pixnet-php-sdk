<?php
class Pix_Blog_ArticlesTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    private function createTempArticle()
    {
        return self::$pixapi->blog->articles->create('Emma unit test article', 'unit test body')['data'];
    }

    private function destroyTempArticle($article)
    {
        self::$pixapi->blog->articles->delete($article['id']);
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->blog->articles->notfound;
    }

    public function testHot()
    {
        $hot = self::$pixapi->blog->articles->hot();
        $this->assertEquals(0, $hot['error']);
    }

    public function testLatest()
    {
        $latest = self::$pixapi->blog->articles->latest();
        $this->assertEquals(0, $latest['error']);
    }
}
