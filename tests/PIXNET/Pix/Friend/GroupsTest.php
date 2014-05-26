<?php
class Pix_Friend_GroupsTest extends PHPUnit_Framework_TestCase
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
        $actual_all = self::$pixapi->friend->groups->search();

        foreach ($actual_all['friend_groups'] as $group) {
            $actual[] = $group['name'];
        }

        $expected = [
           'pixnet',
           'Emma'
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testCreate()
    {
        $actual_all = self::$pixapi->friend->groups->create('friend');
        $actual = $actual_all['friend_group']['name'];

        $this->assertEquals('friend', $actual);
    }

    public function testUpdate()
    {
        $groups = self::$pixapi->friend->groups->search();
        self::$group_id = $groups['friend_groups'][2]['id'];
        $group_name = $groups['friend_groups'][2]['name'];

        $actual = self::$pixapi->friend->groups->update(self::$group_id, 'update');
        $expected = 'update';

        $this->assertEquals($expected, $actual['friend_group']['name']);
    }

    public function testDelete()
    {
        $actual = self::$pixapi->friend->groups->delete(self::$group_id);

        $groups = self::$pixapi->friend->groups->search();
        foreach ($groups['friend_groups'] as $group) {
            $data[] = $group['id'];
        }

        $this->assertFalse(in_array(self::$group_id, $data));
    }
}
