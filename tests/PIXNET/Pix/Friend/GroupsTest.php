<?php
class Pix_Friend_GroupsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $group;

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
    }

    public static function tearDownAfterClass()
    {
        Authentication::tearDownAfterClass();
    }

    public function testCreate()
    {
        $actual_all = self::$pixapi->friend->groups->create('friend');
        self::$group = $actual_all['data'];
        $actual = $actual_all['data']['name'];

        $this->assertEquals('friend', $actual);
    }

    /**
     * @expectedException PixAPIException
     */
    public function testCreateException()
    {
        $actual = self::$pixapi->friend->groups->create('');
    }

    /**
     * @expectedException PixAPIException
     */
    public function testGet()
    {
        self::$pixapi->friend->groups->test->test();
    }

    /**
     * @depends testCreate
     */
    public function testSearch()
    {
        $actual_all = self::$pixapi->friend->groups->search();

        foreach ($actual_all['data'] as $group) {
            $actual[] = $group['name'];
        }

        $this->assertGreaterThanOrEqual(1, count($actual));
    }

    /**
     * @depends testSearch
     */
    public function testSearchSpecifiedId()
    {
        $group_id = intval(self::$group['id']);
        $group_name = self::$group['name'];
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

    /**
     * @depends testSearchSpecifiedId
     */
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

    /**
     * @depends testUpdate
     */
    public function testDelete()
    {
        $test_group = self::$pixapi->friend->groups->create('unit test ' . __METHOD__);
        $actual = self::$pixapi->friend->groups->delete(self::$group['id']);
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
