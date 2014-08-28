<?php
class Pix_Album_Element_CommentsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $test_set;
    public static $test_element;
    public static $fixture_pics = ['350x200-emmatest.png', '350x250-emmatest.png', '400x500-emmatest.png', '550x200-emmatest.png'];

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
        self::$test_set = self::$pixapi->Album->Sets->create('PHP-SDK unit test title', 'PHP-SDK unit test desc', ['cancomment' => 1])['data'];
        $filename = self::$fixture_pics[0];
        $filename = __DIR__ . '/../../../../fixture/' . $filename;
        self::$test_element = self::$pixapi->album->elements->create(self::$test_set['id'], $filename)['data'];
    }

    public static function tearDownAfterClass()
    {
        Authentication::tearDownAfterClass();
        self::$pixapi->Album->Sets->delete(self::$test_set['id']);
    }

    private function createTempComments()
    {
        $comments = [];
        for ($i = 0; $i < 1; $i++) {
            $comments[$i] = self::$pixapi->album->elements->comments->create('emmatest', self::$test_element['id'], 'test message')['data'];
        }
        return $comments;
    }

    private function destoryTempComments($comments)
    {
        foreach ($comments as $c) {
            self::$pixapi->album->elements->comments->delete($c['id']);
        }
    }

    /**
     * @expectedException PixAPIException
     */
    public function testSearchException()
    {
        self::$pixapi->album->elements->comments->search('', '');
    }

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->album->elements->comments->test->test();
    }

    public function testSearchTotal()
    {

        $tempcomments = $this->createTempcomments();
        $expected = [];
        foreach ($tempcomments as $comment) {
            $expected['body'][] = $comment['body'];
            $expected['id'][] = $comment['id'];
        }
        $current = self::$pixapi->album->elements->comments->search('emmatest', [])['data'];

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

    public function testSearchSet()
    {

        $tempcomments = $this->createTempcomments();
        $expected = [];
        foreach ($tempcomments as $comment) {
            $expected['body'][] = $comment['body'];
            $expected['id'][] = $comment['id'];
        }
        $current = self::$pixapi->album->elements->comments->search('emmatest', ['set_id' => self::$test_set['id']])['data'];

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

    public function testSearchComment()
    {
        $tempcomments = $this->createTempcomments()[0];
        $expected = [];
        $expected['body'] = $tempcomments['body'];
        $expected['id'] = $tempcomments['id'];
        $current = self::$pixapi->album->elements->comments->search('emmatest', ['comment_id' => $tempcomments['id']])['data'];
        $this->destoryTempComments([$current]);
        $this->assertEquals($expected['body'], $current['body']);
        $this->assertEquals($expected['id'], $current['id']);
    }

    public function testSearchElement()
    {

        $tempcomments = $this->createTempcomments();
        $expected = [];
        foreach ($tempcomments as $comment) {
            $expected['body'][] = $comment['body'];
            $expected['id'][] = $comment['id'];
        }
        $current = self::$pixapi->album->elements->comments->search('emmatest', ['element_id' => self::$test_element['id']])['data'];

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
        self::$pixapi->album->elements->comments->create('', '', '');
    }

    public function testCreate()
    {
        for ($i = 0; $i < 1; $i++) {
            $body = md5($i);
            $comment = self::$pixapi->album->elements->comments->create('emmatest', self::$test_element['id'], $body)['data'];
            $this->assertEquals($body, $comment['body']);
            self::$pixapi->album->elements->comments->delete($comment['id']);
        }
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        self::$pixapi->album->elements->comments->delete('');
    }

    public function testDelete()
    {
        $tempcomments = $this->createTempComments();
        $expected = count($tempcomments);
        $actual = 0;
        foreach ($tempcomments as $comment) {
            $ret = self::$pixapi->album->elements->comments->delete($comment['id']);
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
        self::$pixapi->album->elements->comments->markSpam('');
    }

    public function testMarkSpam()
    {
        $comments = $this->createTempComments();
        foreach ($comments as $c) {
            $spamc = self::$pixapi->album->elements->comments->markSpam($c['id'])['data'];
            $this->assertEquals(1, $spamc['is_spam']);
        }
        $this->destoryTempComments($comments);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testHamException()
    {
        self::$pixapi->album->elements->comments->markHam('');
    }

    public function testMarkHam()
    {
        $comments = $this->createTempComments();
        foreach ($comments as $c) {
            $spamc = self::$pixapi->album->elements->comments->markHam($c['id'])['data'];
            $this->assertEquals(0, $spamc['is_spam']);
        }
        $this->destoryTempComments($comments);
    }
}
