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

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->friend->groups->test->test();
    }

    public function testSearch()
    {
        $actual_all = self::$pixapi->friend->groups->search();

        foreach ($actual_all['data'] as $group) {
            $actual[] = $group['name'];
        }

        $expected = [
           'pixnet',
           'Emma'
        ];

        $this->assertEquals($expected, $actual);
    }

    public function testSearchSpecifiedId()
    {
        $groups = self::$pixapi->friend->groups->search();
        $group_id = intval($groups['data'][0]['id']);
        $group_name = $groups['data'][0]['name'];
        $actual_all = self::$pixapi->friend->groups->search($group_id);

        $actual = array(
            'id'   => $actual_all['data']['id'],
            'name' => $actual_all['data']['name']
        );

        $expected = array(
            'id' => $group_id,
            'name' => $group_name
        );

        $this->assertEquals($expected, $actual);
    }

    public function testCreate()
    {
        $actual_all = self::$pixapi->friend->groups->create('friend');
        $group_id = $actual_all['data']['id'];
        $actual = $actual_all['data']['name'];

        $this->assertEquals('friend', $actual);
        $actual = self::$pixapi->friend->groups->delete($group_id);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        $actual = self::$pixapi->friend->groups->create('');
    }

    public function testUpdate()
    {
        $groups = self::$pixapi->friend->groups->create('test-update');
        $group_id = $groups['data']['id'];
        $group_name = $groups['data']['name'];

        $actual = self::$pixapi->friend->groups->update($group_id, 'update');
        $expected = 'update';

        $this->assertEquals($expected, $actual['data']['name']);
        $actual = self::$pixapi->friend->groups->delete($group_id);
    }

    /**
     * @expectedException PixAPIException
     * @dataProvider dataUpdateException
     */
    public function testUpdateException($group_id, $name)
    {
        $actual = self::$pixapi->friend->groups->update($group_id, $name);
    }

    public function dataUpdateException()
    {
        return array(
            array('', 'update'),
            array(362627, ''),
            array('', '')
        );
    }

    public function testDelete()
    {
        $test_group = self::$pixapi->friend->groups->create('test-delete');
        $actual = self::$pixapi->friend->groups->delete($test_group['data']['id']);

        $groups = self::$pixapi->friend->groups->search();
        foreach ($groups['data'] as $group) {
            $data[] = $group['id'];
        }

        $this->assertFalse(in_array($test_group['data']['id'], $data));
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->friend->groups->delete('');
    }
}
