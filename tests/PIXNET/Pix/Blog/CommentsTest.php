<?php
class Pix_Blog_CommentsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $test_comments;

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
        self::$test_comments = self::$pixapi->blog->comments->search(['article_id' => 11903807]);
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->blog->comments->notfound;
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSearchException()
    {
        self::$pixapi->blog->comments->search('TEST');
    }

    public function testLatest()
    {
        $actual = self::$pixapi->blog->comments->latest();
        $this->assertLessThanOrEqual(5, $actual['total']);
    }
}
