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
}
