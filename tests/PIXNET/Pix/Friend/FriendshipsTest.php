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

    public function testAppendGroup()
    {
        $friendships = self::$pixapi->friend->friendships->search();
        $name = $friendships['friend_pairs'][2]['user_name'];
        $groups = self::$pixapi->friend->groups->search();
        $group_id = $groups['friend_groups'][0]['id'];

        $actual_all = self::$pixapi->friend->friendships->appendGroup($name, $group_id);
        $actual = array(
            'name'     => $actual_all['friend_pair']['user_name'],
            'group_id' => $actual_all['friend_pair']['groups'][0]['id']
        );

        $expected = array(
            'name'     => $name,
            'group_id' => $group_id
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     * @dataProvider dataAppendGroupException
     */
    public function testAppendGroupException($name, $group_id)
    {
        $actual = self::$pixapi->friend->friendships->appendGroup($name, $group_id);
    }

    public function dataAppendGroupException()
    {
        return array(
            array('', 362624),
            array('emmatest4', ''),
            array('', '')
        );
    }

    public function testRemoveGroup()
    {
        $friendships = self::$pixapi->friend->friendships->search();
        $name = $friendships['friend_pairs'][2]['user_name'];
        $group_id = $friendships['friend_pairs'][2]['groups'][0]['id'];

        $actual_all = self::$pixapi->friend->friendships->removeGroup($name, $group_id)['data'];
        $actual = array(
            'name'     => $actual_all['friend_pair']['user_name'],
            'group_id' => $actual_all['friend_pair']['groups'][0]['id']
        );

        $expected = array(
            'name'     => $name,
            'group_id' => null
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     * @dataProvider dataRemoveGroupException
     */
    public function testRemoveGroupException($name, $group_id)
    {
        $actual = self::$pixapi->friend->friendships->removeGroup($name, $group_id);
    }

    public function dataRemoveGroupException()
    {
        return array(
            array(362624, ''),
            array('', 'emmatest4'),
            array('', '')
        );
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
