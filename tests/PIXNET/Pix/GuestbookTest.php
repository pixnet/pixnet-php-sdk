<?php
class Pix_Guestbook_Test extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $guestbook_id;

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
     * @group test
     */
    public function testCreate()
    {
        $actual = self::$pixapi->guestbook->create('emmatest', 'testtitle', 'testbody');
        self::$guestbook_id = $actual['data']['id'];

        $this->assertEquals('testtitle', $actual['data']['title']);
        $this->assertEquals('testbody', $actual['data']['body']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        $actual = self::$pixapi->guestbook->create('', '', '');
    }

    public function testSearch()
    {
        $actual = self::$pixapi->guestbook->search();

        foreach ($actual['data'] as $g) {
            if ($g['id'] != self::$guestbook_id) {
                self::$pixapi->guestbook->delete($g['id']);
            }
        }
        $actual = self::$pixapi->guestbook->search();
        $this->assertCount(1, $actual['data']);
    }

    public function testSearchId()
    {
        $actual = self::$pixapi->guestbook->search(self::$guestbook_id);

        $this->assertEquals(self::$guestbook_id, $actual['data']['id']);
    }

    public function testReply()
    {
        $actual = self::$pixapi->guestbook->reply(self::$guestbook_id, 'testreply');

        $this->assertEquals('testreply', $actual['data']['reply']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testReplyException()
    {
        $actual = self::$pixapi->guestbook->reply('', '');
    }

    public function testOpen()
    {
        $actual = self::$pixapi->guestbook->open(self::$guestbook_id);

        $this->assertEquals(1, $actual['data']['is_open']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testOpenException()
    {
        $actual = self::$pixapi->guestbook->open('');
    }

    public function testClose()
    {
        $actual = self::$pixapi->guestbook->close(self::$guestbook_id);

        $this->assertEquals(0, $actual['data']['is_open']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCloseException()
    {
        $actual = self::$pixapi->guestbook->close('');
    }

    public function testMarkSpam()
    {
        $actual = self::$pixapi->guestbook->markSpam(self::$guestbook_id);

        $this->assertEquals(1, $actual['data']['is_spam']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testMarkSpamException()
    {
        $actual = self::$pixapi->guestbook->markSpam('');
    }

    public function testMarkHam()
    {
        $actual = self::$pixapi->guestbook->markHam(self::$guestbook_id);

        $this->assertEquals(00, $actual['data']['is_spam']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testMarkHamException()
    {
        $actual = self::$pixapi->guestbook->markHam('');
    }

    public function testDelete()
    {
        self::$pixapi->guestbook->delete(self::$guestbook_id);
        $actual = self::$pixapi->guestbook->search();

        $this->assertEquals(0, $actual['total']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->guestbook->delete('');
    }

    /**
     * @expectedException PixAPIException
     * @expectedExceptionCode PixAPIException::CLASS_NOT_FOUND
     */
    public function testSubClassNotFoundException()
    {
        $actual = self::$pixapi->guestbook->notfound;
    }
}
