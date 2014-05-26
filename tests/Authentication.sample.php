<?php
class Authentication
{
    public static $pixapi;

    public static function setUpBeforeClass()
    {
        @session_start();
        // Set Your APP key, secret and callback
        self::$pixapi = $api = new PixAPI(array(
            'key' => '',
            'secret' => '',
            'callback' => ''
        ));

        // Set Your refresh token for APP
        // you can get it in PIXNET API Explode http://devtool.pixnet.pro/#/
        $api->setRefreshToken('');
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
