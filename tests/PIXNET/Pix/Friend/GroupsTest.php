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
        self::$pixapi->friend->groups->test->test();
    }

    public function testSearch()
    {
        $temp_group = $this->createTempGroup();
        $actual_all = self::$pixapi->friend->groups->search();
        $this->destroyTempGroup($temp_group);

        foreach ($actual_all['data'] as $group) {
            $actual[] = $group['name'];
        }

        $expected = [$temp_group['name']];

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
        $test_group = self::$pixapi->friend->groups->create('unit test ' . __METHOD__);
        $actual = self::$pixapi->friend->groups->delete($test_group['data']['id']);
        $this->assertEquals(0, $actual['error']);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testDeleteException()
    {
        $actual = self::$pixapi->friend->groups->delete('');
    }
}
