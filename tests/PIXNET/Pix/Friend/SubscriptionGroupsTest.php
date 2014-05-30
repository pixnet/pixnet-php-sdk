<?php
class Pix_Friend_SubscriptionGroupsTest extends PHPUnit_Framework_TestCase
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
        $actual_all = self::$pixapi->friend->subscriptionGroups->search();

        foreach ($actual_all['subscription_groups'] as $group) {
            $actual[] = array(
                'name'     => $group['name'],
                'position' => $group['position']
            );

            self::$group_id[] = $group['id'];
        }

        $expected = array(
            array(
                'name'     => 'pixnet',
                'position' => 0
            ),
            array(
                'name'     => 'Emma',
                'position' => 1
            )
        );

        $this->assertEquals($expected, $actual);
    }

    public function testSearchSpecifiedId()
    {
        $groups = self::$pixapi->friend->subscriptionGroups->search();
        $group_id = intval($groups['subscription_groups'][0]['id']);
        $group_name = $groups['subscription_groups'][0]['name'];
        $group_position = intval($groups['subscription_groups'][0]['position']);

        $actual_all = self::$pixapi->friend->subscriptionGroups->search($group_id);

        $actual = array(
            'id'       => $actual_all['subscription_group']['id'],
            'name'     => $actual_all['subscription_group']['name'],
            'position' => $actual_all['subscription_group']['position'],
        );

        $expected = array(
            'id'       => $group_id,
            'name'     => $group_name,
            'position' => $group_position
        );

        $this->assertEquals($expected, $actual);
    }

    public function testCreate()
    {
        $actual_create_1 = self::$pixapi->friend->subscriptionGroups->create('friend');
        self::$group_id[] = $actual_create_1['subscription_group']['id'];
        $actual_create_2 = self::$pixapi->friend->subscriptionGroups->create('test');
        self::$group_id[] = $actual_create_2['subscription_group']['id'];

        $actual = array(
            array(
                'name'     => $actual_create_1['subscription_group']['name'],
                'position' => $actual_create_1['subscription_group']['position']
            ),
            array(
                'name'     => $actual_create_2['subscription_group']['name'],
                'position' => $actual_create_2['subscription_group']['position']
            )
        );

        $expected = array(
            array(
                'name'     => 'friend',
                'position' => 2
            ),
            array(
                'name'     => 'test',
                'position' => 3
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
        $groups = self::$pixapi->friend->subscriptionGroups->search();
        $group_id = $groups['subscription_groups'][3]['id'];

        $actual_all = self::$pixapi->friend->subscriptionGroups->update($group_id, 'update');
        $actual = array(
            $actual_all['subscription_group']['name'],
            $actual_all['subscription_group']['position']
        );

        $expected = array(
            'update',
            3
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
        $id = self::$group_id[0] . ','
            . self::$group_id[1] . ','
            . self::$group_id[3] . ','
            . self::$group_id[2];
        $actual_all = self::$pixapi->friend->subscriptionGroups->position($id);

        foreach ($actual_all['subscription_groups'] as $group) {
            $actual[] = array(
                'id'     => $group['id'],
                'position' => $group['position']
            );
        }

        $expected = array(
            array(
                'id'     => self::$group_id[0],
                'position' => 0
            ),
            array(
                'id'     => self::$group_id[1],
                'position' => 1
            ),
            array(
                'id'     => self::$group_id[3],
                'position' => 2
            ),
            array(
                'id'     => self::$group_id[2],
                'position' => 3
            ),
        );

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
        $delete = self::$pixapi->friend->subscriptionGroups->delete(self::$group_id[2]);
        $delete = self::$pixapi->friend->subscriptionGroups->delete(self::$group_id[3]);

        $actual_all = self::$pixapi->friend->subscriptionGroups->search();
        foreach ($actual_all['subscription_groups'] as $group) {
            $actual[] = array(
                'name'     => $group['name'],
                'position' => $group['position']
            );
        }

        $expected = array(
            array(
                'name'     => 'pixnet',
                'position' => 0
            ),
            array(
                'name'     => 'Emma',
                'position' => 1
            )
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->friend->subscriptionGroups->delete('');
    }
}
