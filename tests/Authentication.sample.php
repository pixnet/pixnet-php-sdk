<?php
class Authentication
{
    public static $pixapi;

    public static function setUpBeforeClass()
    {
        @session_start();
        self::$pixapi = $api = new PixAPI(array(
            'key' => '',
            'secret' => '',
            'callback' => ''
        ));

        $api->setToken('', '');
        $api->refreshAuth();
    }

    public static function tearDownAfterClass()
    {
        session_destroy();
    }

    public function setUp()
    {
    }

    public function tearDown()
    {
    }
}
