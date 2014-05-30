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

    public function testSearch()
    {
        $actual_all = self::$pixapi->friend->subscriptions->search();

        foreach ($actual_all['subscriptions'] as $detail) {
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
        $user_name = $subscriptions['subscriptions'][0]['user']['name'];

        $actual_all = self::$pixapi->friend->subscriptions->search($user_name);

        $actual = $actual_all['subscription']['user']['name'];

        $expected = $user_name;

        $this->assertEquals($expected, $actual);
    }

    public function testCreateHasGroup()
    {
        $ids = self::$pixapi->friend->subscriptionGroups->search();
        $id = $ids['subscription_groups'][0]['id'];
        $actual_create = self::$pixapi->friend->subscriptions->create('emmatest3', array('group_ids' => $id));

        $actual = array(
            'name' => $actual_create['subscription']['user']['name'],
            'id'   => $actual_create['subscription']['groups'][0]['id'],
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
            'name' => $actual_create['subscription']['user']['name'],
            'group' => $actual_create['subscription']['groups']['id']
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
        $group_id = $groups['subscription_groups'][0]['id'];

        $actual_all = self::$pixapi->friend->subscriptions->joinSubscriptionGroup('emmatest4', array('group_ids' => $group_id));
        $actual = array(
            $actual_all['subscription']['user']['name'],
            $actual_all['subscription']['groups'][0]['id']
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
        $name = $subscriptions['subscriptions'][2]['user']['name'];
        $group_id = $subscriptions['subscriptions'][2]['groups'][0]['id'];

        $actual_all = self::$pixapi->friend->subscriptions->leaveSubscriptionGroup($name, array('group_ids' => $group_id));
        $actual = array(
            $actual_all['subscription']['user']['name'],
            $actual_all['subscription']['groups'][0]['id']
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
        foreach ($actual_all['subscriptions'] as $detail) {
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
