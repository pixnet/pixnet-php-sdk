<?php
class Pix_Album_Element_CommentsTest extends PHPUnit_Framework_TestCase
{
    public static $pixapi;
    public static $test_set;
    public static $test_element;

    public static function setUpBeforeClass()
    {
        Authentication::setUpBeforeClass();
        self::$pixapi = Authentication::$pixapi;
        self::$test_set = self::$pixapi->Album->Sets->search('emmatest')[0];
        self::$test_element = self::$pixapi->album->sets->elements('emmatest', self::$test_set['id'])[0];
    }

    private function createTempComments()
    {
        $comments = [];
        for ($i = 0; $i < 5; $i++) {
            $comments[$i] = self::$pixapi->album->elements->comments->create('emmatest', self::$test_element['id'], 'test message');
            echo "create " . $comments[$i]['id'] . PHP_EOL;
        }
        return $comments;
    }

    private function destoryTempComments($comments)
    {
        foreach ($comments as $c) {
            echo "delete " . $c['id'] . PHP_EOL;
            self::$pixapi->album->elements->comments->delete($c['id']);
        }
    }
}
