<?php
class Pix_Album_commentsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $test_set;

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
        self::$test_set = self::$pixapi->Album->Sets->search('emmatest')[0];
    }

    private function createTempComments()
    {
        $comments = [];
        for ($i = 0; $i < 5; $i++) {
            $comments[$i] = self::$pixapi->Album->comments->create('emmatest', self::$test_set['id'], 'test message');
        }
        return $comments;
    }

    private function destoryTempComments($comments)
    {
        foreach ($comments as $c) {
            self::$pixapi->Album->comments->delete($c['id']);
        }
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSearchException()
    {
        self::$pixapi->Album->comments->search('', '');
    }

    public function testSearchSet()
    {

        $tempcomments = $this->createTempcomments();
        $expected = [];
        foreach ($tempcomments as $comment) {
            $expected['body'][] = $comment['body'];
            $expected['id'][] = $comment['id'];
        }
        $current = self::$pixapi->Album->comments->search('emmatest', ['set_id' => self::$test_set['id']]);

        foreach ($current as $comment) {
            $actual['id'][] = $comment['id'];
            $actual['body'][] = $comment['body'];
        }

        foreach ($expected['body'] as $comment) {
            $this->assertTrue(in_array($comment, $actual['body']));
        }

        foreach ($expected['id'] as $comment) {
            $this->assertTrue(in_array($comment, $actual['id']));
        }

        $this->destoryTempComments($current);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        self::$pixapi->album->comments->create('', '', '');
    }

    public function testCreate()
    {
        for ($i = 0; $i < 5; $i++) {
            $body = md5($i);
            $comment = self::$pixapi->Album->comments->create('emmatest', self::$test_set['id'], $body);
            $this->assertEquals($body, $comment['body']);
            self::$pixapi->Album->comments->delete($comment['id']);
        }
    }
}
