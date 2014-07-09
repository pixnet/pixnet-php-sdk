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
        self::$test_element = self::$pixapi->album->sets->elements('emmatest', self::$test_set['id']);
    }
}
