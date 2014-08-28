<?php
class Pix_Album_commentsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $test_set;

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
        self::$test_set = self::$pixapi->Album->Sets->create('PHP-SDK unit test title', 'PHP-SDK unit test desc', ['cancomment' => 1])['data'];
    }

    public static function tearDownAfterClass()
    {
        self::$pixapi->Album->Sets->delete(self::$test_set['id']);
    }

    private function createTempComments()
    {
        $comments = [];
        for ($i = 0; $i < 1; $i++) {
            $comments[$i] = self::$pixapi->Album->comments->create('emmatest', self::$test_set['id'], 'test message')['data'];
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
    public function testGet()
    {
        self::$pixapi->album->comments->test->test();
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSearchException()
    {
        self::$pixapi->Album->comments->search('', '');
    }

    public function testSearchComment()
    {
        $tempcomment = self::$pixapi->Album->comments->create('emmatest', self::$test_set['id'], 'test message')['data'];
        $expected['body'] = $tempcomment['body'];
        $expected['id'] = $tempcomment['id'];
        $current = self::$pixapi->Album->comments->search('emmatest', ['comment_id' => $tempcomment['id']])['data'];
        $this->assertEquals($current['body'], $expected['body']);
        $this->assertEquals($current['id'], $expected['id']);
        $this->destoryTempComments([$tempcomment]);
    }

    public function testSearchSet()
    {

        $tempcomments = $this->createTempcomments();
        $expected = [];
        foreach ($tempcomments as $comment) {
            $expected['body'][] = $comment['body'];
            $expected['id'][] = $comment['id'];
        }
        $current = self::$pixapi->Album->comments->search('emmatest', ['set_id' => self::$test_set['id']])['data'];

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
            $comment = self::$pixapi->Album->comments->create('emmatest', self::$test_set['id'], $body)['data'];
            $this->assertEquals($body, $comment['body']);
            self::$pixapi->Album->comments->delete($comment['id']);
        }
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        self::$pixapi->album->comments->delete('');
    }

    public function testDelete()
    {
        $tempcomments = $this->createTempComments();
        $expected = count($tempcomments);
        $actual = 0;
        foreach ($tempcomments as $comment) {
            $ret = self::$pixapi->album->comments->delete($comment['id']);
            if (!$ret['error']) {
                $actual++;
            }
        }
        $this->assertEquals($actual, $expected);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSpamException()
    {
        self::$pixapi->album->comments->markSpam('');
    }

    public function testMarkSpam()
    {
        $comments = $this->createTempComments();
        foreach ($comments as $c) {
            $spamc = self::$pixapi->Album->comments->markSpam($c['id'])['data'];
            $this->assertEquals(1, $spamc['is_spam']);
        }
        $this->destoryTempComments($comments);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testHamException()
    {
        self::$pixapi->album->comments->markHam('');
    }

    public function testMarkHam()
    {
        $comments = $this->createTempComments();
        foreach ($comments as $c) {
            $spamc = self::$pixapi->Album->comments->markHam($c['id'])['data'];
            $this->assertEquals(0, $spamc['is_spam']);
        }
        $this->destoryTempComments($comments);
    }
}
