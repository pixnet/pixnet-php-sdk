<?php
class Pix_Friend_FriendshipsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $group_id;

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    public static function tearDownAfterClass()
    {
        $delete = self::$pixapi->friend->subscriptions->delete('emmatest4');
        Authentication::tearDownAfterClass();
    }

    public function testSearch()
    {
        $actual_all = self::$pixapi->friend->friendships->search();

        foreach ($actual_all['friend_pairs'] as $key => $detail) {
            $actual[$key] = array(
                'user_name' => $detail['user_name']
            );
            if (!$detail['groups']) {
                $actual[$key]['groups'] = array();
                continue;
            }
            foreach ($detail['groups'] as $group) {
                $actual[$key]['groups'] = array(
                    'group_name' => $group['name']
                );
            }
        }

        $expected = array(
            array(
                'user_name' => 'emmatest2',
                'groups' => array(
                    'group_name' => 'pixnet'
                )
            ),
            array(
                'user_name' => 'emmatest3',
                'groups' => array()
            )
        );

        $this->assertEquals($expected, $actual);
    }

    public function testCreate()
    {
        $actual_all = self::$pixapi->friend->friendships->create('emmatest4');

        $actual = $actual_all['friend_pair']['user_name'];

        $expected = 'emmatest4';

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        $actual = self::$pixapi->friend->friendships->create('');
    }

    public function testDelete()
    {
        $delete = self::$pixapi->friend->friendships->delete('emmatest4');

        $actual_all = self::$pixapi->friend->friendships->search();
        foreach ($actual_all['friend_pairs'] as $detail) {
            $actual[] = $detail['user_name'];
        }

        $this->assertFalse(in_array('emmatest4', $actual));


    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->friend->friendships->delete('');
    }
}
