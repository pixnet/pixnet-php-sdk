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

    private function createTempFriendships()
    {
        for ($i = 2; $i < 4; $i++) {
            $friendships[] = self::$pixapi->friend->friendships->create('emmatest' . $i)['data'];
        }
        return $friendships;
    }

    private function destroyTempFriendships($friendships)
    {
        foreach ($friendships as $f) {
            self::$pixapi->friend->friendships->delete($f['user_name']);
            self::$pixapi->friend->subscriptions->delete($f['user_name']);
        }
    }

    private function createTempGroup()
    {
        return self::$pixapi->friend->groups->create(__METHOD__)['data'];
    }

    private function destroyTempGroup($group)
    {
        return self::$pixapi->friend->groups->delete($group['id']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->friend->friendships->test->test();
    }

    public function testSearch()
    {
        $temp_friendships = $this->createTempFriendships();
        $actual_all = self::$pixapi->friend->friendships->search()['data'];
        $this->destroyTempFriendships($temp_friendships);

        foreach ($actual_all as $key => $detail) {
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
                'groups' => array(
                )
            )
        );

        $this->assertEquals($expected, $actual);
    }

    public function testCreate()
    {
        $actual_all = self::$pixapi->friend->friendships->create('emmatest4')['data'];
        self::$pixapi->friend->friendships->delete('emmatest4')['data'];

        $actual = $actual_all['user_name'];

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
        $friendships = $this->createTempFriendships();
        $group = $this->createTempGroup();
        foreach ($friendships as $f) {
            $expected = self::$pixapi->friend->friendships->appendGroup($f['user_name'], $group['id']);
            $this->assertEquals($expected['data']['groups'][0]['id'], $group['id']);
        }
        $this->destroyTempGroup($group);
        $this->destroyTempFriendships($friendships);
    }

    /**
     * @expectedException PixAPIException
     * @dataProvider dataAppendGroupException
     */
    public function testAppendGroupException($name, $group_id)
    {
        $actual = self::$pixapi->friend->friendships->appendGroup($name, $group_id)['data'];
    }

    /**
     */
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
        $friendships = $this->createTempFriendships();
        $group = $this->createTempGroup();
        foreach ($friendships as $f) {
            $expected = self::$pixapi->friend->friendships->appendGroup($f['user_name'], $group['id']);
        }
        foreach ($friendships as $f) {
            $actual = self::$pixapi->friend->friendships->removeGroup($f['user_name'], $group['id']);
        }
        $actual_friendships = self::$pixapi->friend->friendships->search()['data'];
        foreach ($actual_friendships as $f) {
            $this->assertTrue(empty($f['groups']));
        }
        $this->destroyTempGroup($group);
        $this->destroyTempFriendships($friendships);
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
        self::$pixapi->friend->friendships->create('emmatest4');
        $actual = self::$pixapi->friend->friendships->delete('emmatest4');
        $this->assertEquals(0, $actual['error']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->friend->friendships->delete('');
    }
}
