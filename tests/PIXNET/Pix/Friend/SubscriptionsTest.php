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

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->friend->subscriptions->test->test();
    }

    public function testSearch()
    {
        $delete = self::$pixapi->friend->subscriptions->delete('emmatest4');
        $actual_all = self::$pixapi->friend->subscriptions->search();

        foreach ($actual_all['data'] as $detail) {
            $actual[] = $detail['user']['name'];
        }

        $expected = array(
            'emmatest2'
        );

        $this->assertEquals($expected, $actual);
    }

    public function testSearchSpecifiedUser()
    {
        $subscriptions = self::$pixapi->friend->subscriptions->search();
        $user_name = $subscriptions['data'][0]['user']['name'];

        $actual_all = self::$pixapi->friend->subscriptions->search($user_name);

        $actual = $actual_all['data']['user']['name'];

        $expected = $user_name;

        $this->assertEquals($expected, $actual);
    }

    public function testCreateHasGroup()
    {
        $ids = self::$pixapi->friend->subscriptionGroups->search();
        $id = $ids['data'][0]['id'];
        $actual_create = self::$pixapi->friend->subscriptions->create('emmatest3', array('group_ids' => $id));

        $actual = array(
            'name' => $actual_create['data']['user']['name'],
            'id'   => $actual_create['data']['groups'][0]['id'],
        );

        $expected = array(
            'name' => 'emmatest3',
            'id'   => $id
        );

        $this->assertEquals($expected, $actual);
    }

    public function testCreateNoGroup()
    {
        $actual_create = self::$pixapi->friend->subscriptions->create('emmatest4');

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
        $groups = self::$pixapi->friend->subscriptionGroups->search();
        $group_id = $groups['data'][0]['id'];

        $actual_all = self::$pixapi->friend->subscriptions->joinSubscriptionGroup('emmatest4', array('group_ids' => $group_id));
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
        $subscriptions = self::$pixapi->friend->subscriptions->search();
        $name = $subscriptions['data'][2]['user']['name'];
        $group_id = $subscriptions['data'][2]['groups'][0]['id'];

        $actual_all = self::$pixapi->friend->subscriptions->leaveSubscriptionGroup($name, array('group_ids' => $group_id));
        $actual = array(
            $actual_all['data']['user']['name'],
            $actual_all['data']['groups'][0]['id']
        );

        $expected = array(
            'emmatest4',
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
        $delete = self::$pixapi->friend->subscriptions->delete('emmatest3');
        $delete = self::$pixapi->friend->subscriptions->delete('emmatest4');

        $actual_all = self::$pixapi->friend->subscriptions->search();
        foreach ($actual_all['data'] as $detail) {
            $actual[] = $detail['user']['name'];
        }

        $expected = array(
            'emmatest2'
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->friend->subscriptions->delete('');
    }
}
