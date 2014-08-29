<?php
class Pix_Blog_CommentsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    private function createTempArticle()
    {
        return self::$pixapi->blog->articles->create('Emma unit test article', 'unit test body', ['cancomment' => 1])['data'];
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
        $actual = self::$pixapi->blog->comments->notfound;
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSearchException()
    {
        self::$pixapi->blog->comments->search('TEST');
    }

    public function testSearchArticleComments()
    {
        $article = $this->createTempArticle();
        for ($i = 0; $i < 5; $i++) {
            $body = "unit test" . md5(time);
            self::$pixapi->blog->comments->create('emmatest', $article['id'], $body)['data'];
        }
        $actual = self::$pixapi->blog->comments->search(['article_id' => $article['id']]);
        $this->assertEquals($i, $actual['total']);
        $this->destroyTempArticle($article);
    }

    public function testSearchAll()
    {
        $comments = self::$pixapi->blog->comments->search();
        $this->assertEquals(35, $comments['total']);
    }

    public function testSearchComment()
    {
        $article = $this->createTempArticle();
        $body = "unit test" . md5(time);
        $comment = self::$pixapi->blog->comments->create('emmatest', $article['id'], $body)['data'];
        $expected = $comment['body'];
        $actual = self::$pixapi->blog->comments->search($comment['id'])['data'];
        $this->assertEquals($expected, $actual['body']);
        $this->destroyTempArticle($article);
    }

    public function testCreate()
    {
        $article = $this->createTempArticle();
        $body = "unit test";
        $comment = self::$pixapi->blog->comments->create('emmatest', $article['id'], $body)['data'];
        $expected = $comment['body'];
        $actual = self::$pixapi->blog->comments->search($comment['id'])['data'];
        $this->assertEquals($expected, $actual['body']);
        $this->destroyTempArticle($article);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        self::$pixapi->blog->comments->create('emmatest', '', '');
    }

    public function testReply()
    {
        $article = $this->createTempArticle();
        $body = "unit test";
        $comment = self::$pixapi->blog->comments->create('emmatest', $article['id'], $body)['data'];
        $expected = $comment['body'];
        $reply_body = "reply unit test";
        $reply = self::$pixapi->blog->comments->reply($comment['id'], $reply_body)['data'];
        $actual = self::$pixapi->blog->comments->search($comment['id']);
        $this->assertEquals($reply_body, $actual['data']['reply']['body']);
        $this->destroyTempArticle($article);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testReplyException()
    {
        self::$pixapi->blog->comments->reply('','');
    }

    public function testLatest()
    {
        $actual = self::$pixapi->blog->comments->latest();
        $this->assertLessThanOrEqual(5, $actual['total']);
    }
}
