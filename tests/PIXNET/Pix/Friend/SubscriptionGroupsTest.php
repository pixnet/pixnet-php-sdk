<?php
class Pix_Friend_SubscriptionGroupsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;

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
        self::$pixapi->friend->subscriptionGroups->test->test();
    }

    public function testSearch()
    {
        $expected = self::$pixapi->friend->subscriptionGroups->create('friend');
        $actual = self::$pixapi->friend->subscriptionGroups->search($expected['data']['id']);
        self::$pixapi->friend->subscriptionGroups->delete($expected['data']['id']);

        $this->assertEquals($expected['data'], $actual['data']);
    }

    public function testCreate()
    {
        $actual_create_1 = self::$pixapi->friend->subscriptionGroups->create('friend');
        $actual_create_2 = self::$pixapi->friend->subscriptionGroups->create('test');
        self::$pixapi->friend->subscriptionGroups->delete($actual_create_1['data']['id']);
        self::$pixapi->friend->subscriptionGroups->delete($actual_create_2['data']['id']);

        $actual = array(
            array(
                'name'     => $actual_create_1['data']['name'],
                'position' => $actual_create_1['data']['position']
            ),
            array(
                'name'     => $actual_create_2['data']['name'],
                'position' => $actual_create_2['data']['position']
            )
        );

        $expected = array(
            array(
                'name'     => 'friend',
                'position' => '1'
            ),
            array(
                'name'     => 'test',
                'position' => '2'
            )
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        $actual = self::$pixapi->friend->subscriptionGroups->create('');
    }

    public function testUpdate()
    {
        $actual_create_1 = self::$pixapi->friend->subscriptionGroups->create('friend');
        $actual = self::$pixapi->friend->subscriptionGroups->update($actual_create_1['data']['id'], 'update');
        self::$pixapi->friend->subscriptionGroups->delete($actual_create_1['data']['id']);
        $actual = array(
            $actual['data']['name'],
            $actual['data']['position']
        );

        $expected = array(
            'update',
            1
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     * @dataProvider dataUpdateException
     */
    public function testUpdateException($group_id, $name)
    {
        $actual = self::$pixapi->friend->subscriptionGroups->update($group_id, $name);
    }

    public function dataUpdateException()
    {
        return array(
            array('', 'update'),
            array(362627, ''),
            array('', '')
        );
    }

    public function testPosition()
    {
        for ($i = 0; $i < 4; $i++) {
            $groups[] = self::$pixapi->friend->subscriptionGroups->create('friend-' . $i)['data'];
        }
        arsort($groups);
        $i = 0;
        foreach ($groups as $group) {
            $expected[] = ['id' => $group['id'], 'position' => $i++];
            $ids[] = $group['id'];
        }
        $new_positions = implode(',', $ids);
        $actual_all = self::$pixapi->friend->subscriptionGroups->position($new_positions);

        foreach ($actual_all['data'] as $group) {
            $actual[] = array(
                'id'     => $group['id'],
                'position' => $group['position']
            );
        }

        foreach ($groups as $group) {
            self::$pixapi->friend->subscriptionGroups->delete($group['id']);
        }
        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testPositionException()
    {
        $actual = self::$pixapi->friend->subscriptionGroups->position('');
    }

    public function testDelete()
    {
        $actual_create_1 = self::$pixapi->friend->subscriptionGroups->create('friend');
        $actual_create_2 = self::$pixapi->friend->subscriptionGroups->create('test');
        $actual = self::$pixapi->friend->subscriptionGroups->search();
        $this->assertEquals(2, $actual['total']);

        self::$pixapi->friend->subscriptionGroups->delete($actual_create_1['data']['id']);
        self::$pixapi->friend->subscriptionGroups->delete($actual_create_2['data']['id']);
        $actual = self::$pixapi->friend->subscriptionGroups->search();
        $this->assertEquals(0, $actual['total']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->friend->subscriptionGroups->delete('');
    }
}
