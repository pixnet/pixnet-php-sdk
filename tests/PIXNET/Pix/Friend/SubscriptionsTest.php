<?php
class Pix_Friend_SubscriptionsTest extends PHPUnit_Framework_TestCase
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

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->friend->subscriptions->test->test();
    }

    public function testSearch()
    {
        $friendships = $this->createTempFriendships();
        $actual_all = self::$pixapi->friend->subscriptions->search()['data'];
        $this->destroyTempFriendships($friendships);
        foreach ($friendships as $f) {
            $expected[] = $f['user_name'];
        }
        foreach ($actual_all as $f) {
            $actual[] = $f['user']['name'];
        }
        $this->assertEquals($expected, $actual);
    }

    public function testSearchSpecifiedUser()
    {
        $subscription = self::$pixapi->friend->subscriptions->create('emmatest');
        $user_name = $subscription['data']['user']['name'];

        $actual_all = self::$pixapi->friend->subscriptions->search($user_name);
        self::$pixapi->friend->subscriptions->delete('emmatest');

        $actual = $actual_all['data']['user']['name'];

        $expected = $user_name;

        $this->assertEquals($expected, $actual);
    }

    public function testCreateHasGroup()
    {
        $sub_group = self::$pixapi->friend->subscriptionGroups->create(__METHOD__);
        $actual_create = self::$pixapi->friend->subscriptions->create('emmatest3', array('group_ids' => $sub_group['data']['id']));
        self::$pixapi->friend->subscriptions->delete('emmatest3');
        self::$pixapi->friend->subscriptionGroups->delete($sub_group['data']['id']);

        $actual = array(
            'name' => $actual_create['data']['user']['name'],
            'id'   => $actual_create['data']['groups'][0]['id'],
        );

        $expected = array(
            'name' => 'emmatest3',
            'id'   => $sub_group['data']['id']
        );

        $this->assertEquals($expected, $actual);
    }

    public function testCreateNoGroup()
    {
        $actual_create = self::$pixapi->friend->subscriptions->create('emmatest4');
        self::$pixapi->friend->subscriptions->delete('emmatest4');

        $actual = array(
            'name' => $actual_create['data']['user']['name'],
            'group' => $actual_create['data']['groups']['id']
        );

        $expected = array(
            'name' => 'emmatest4',
            'group' => null
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        $actual = self::$pixapi->friend->subscriptions->create('');
    }

    public function testJoinSubscriptionGroup()
    {
        $group = self::$pixapi->friend->subscriptionGroups->create(__METHOD__);
        self::$pixapi->friend->subscriptions->create('emmatest4');
        $group_id = $group['data']['id'];

        $actual_all = self::$pixapi->friend->subscriptions->joinSubscriptionGroup('emmatest4', array('group_ids' => $group_id));
        self::$pixapi->friend->subscriptions->delete('emmatest4');
        self::$pixapi->friend->subscriptionGroups->delete($group_id);
        $actual = array(
            $actual_all['data']['user']['name'],
            $actual_all['data']['groups'][0]['id']
        );

        $expected = array(
            'emmatest4',
            $group_id
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     * @dataProvider dataJoinSubscriptionGroupException
     */
    public function testJoinSubscriptionException($name, $group_id)
    {
        $actual = self::$pixapi->friend->subscriptions->joinSubscriptionGroup($name, $group_id);
    }

    public function dataJoinSubscriptionGroupException()
    {
        return array(
            array('', 149264),
            array('emmatest4', ''),
            array('', '')
        );
    }

    public function testLeaveSubscriptionGroup()
    {
        $group = self::$pixapi->friend->subscriptionGroups->create(__METHOD__);
        self::$pixapi->friend->subscriptions->create('emmatest4');
        $group_id = $group['data']['id'];

        self::$pixapi->friend->subscriptions->joinSubscriptionGroup('emmatest4', array('group_ids' => $group_id));

        $actual_all = self::$pixapi->friend->subscriptions->leaveSubscriptionGroup('emmatest4', array('group_ids' => $group_id));
        $actual = array(
            $actual_all['data']['groups'][0]['id']
        );
        self::$pixapi->friend->subscriptions->delete('emmatest4');
        self::$pixapi->friend->subscriptionGroups->delete($group_id);

        $expected = array(
            null
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     * @dataProvider dataLeaveSubscriptionGroupException
     */
    public function testLeaveSubscriptionException($name, $group_id)
    {
        $actual = self::$pixapi->friend->subscriptions->leaveSubscriptionGroup($name, $group_id);
    }

    public function dataLeaveSubscriptionGroupException()
    {
        return array(
            array('', 149264),
            array('emmatest4', ''),
            array('', '')
        );
    }

    public function testDelete()
    {
        $actual = self::$pixapi->friend->subscriptions->create('emmatest');
        $this->assertEquals(1, $actual['total']);
        $actual = self::$pixapi->friend->subscriptions->delete('emmatest');
        $this->assertEquals(0, $actual['error']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->friend->subscriptions->delete('');
    }
}
