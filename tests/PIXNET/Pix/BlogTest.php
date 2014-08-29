<?php
class Pix_BlogTest extends PHPUnit_Framework_TestCase
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

    public function testInfo()
    {
        $actual = self::$pixapi->blog->info()['data'];
        $this->assertEquals('emmatest的部落格', $actual['name']);

        $actual = self::$pixapi->blog->info(self::$pixapi->getUserName())['data'];
        $this->assertEquals('emmatest的部落格', $actual['name']);
    }

    public function testSiteCategories()
    {
        $actual = self::$pixapi->blog->siteCategories()['data'];
        $this->assertCount(41, $actual);
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->blog->notfound;
    }

    public function testSuggestedTags()
    {
        $tags = self::$pixapi->blog->suggestedTags();
        $this->assertEquals(2, count($tags['data']));
    }
}
