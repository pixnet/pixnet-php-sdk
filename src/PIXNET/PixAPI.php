<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class PixAPI
{
    const PIXNET_API = 'https://emma.pixnet.cc/';
    const SESSION_NAME = 'PixAPI';

    private $consumer_key;
    private $consumer_secret;
    private $callback_uri;
    private $access_token = null;
    private $refresh_token = null;

    protected $client;
    protected $query_username;
    protected $debugmode = false;
    /**
     * __construct
     *
     * @param $config
     * @access public
     * @return void
     */
    public function __construct($config)
    {
        if (!function_exists('curl_init')) {
            throw new Exception('PIXNET SDK needs the CURL PHP extension.', PixAPIException::CURL_NOT_FOUND);
        }
        if (!function_exists('json_decode')) {
            throw new Exception('PIXNET SDK needs the JSON PHP extension.', PixAPIException::JSON_NOT_FOUND);
        }
        if ((function_exists('session_status') && PHP_SESSION_ACTIVE !== session_status()) || '' == strval(session_id())) {
            throw new Exception('run session_start() first', PixAPIException::SESSION_MISSING);
        }
        if ('' == $config['key'] || '' == $config['secret'] || '' == $config['callback']) {
            throw new Exception('key, secret and callback is need', PixAPIException::CONFIG_MISSING);
        }
        ob_start();
        $this->consumer_key = $config['key'];
        $this->consumer_secret = $config['secret'];
        $this->callback_uri = $config['callback'];
        $this->client = new PixClient($this->consumer_key, $this->consumer_secret);
    }

    public function __get($class_name)
    {
        $class_name = strtolower($class_name);
        $class_list = array(
                'index' => 'Pix_Index',
                'user' => 'Pix_User',
                'blog' => 'Pix_Blog',
                'site' => 'Pix_Site',
                'album' => 'Pix_Album ',
                'friend' => 'Pix_Friend',
                'guestbook' => 'Pix_Guestbook',
                'block' => 'Pix_Block',
                'mainpage' => 'Pix_Mainpage'
            );
        $class = $class_list[$class_name];
        if ('' != $class) {
            return new $class($this->client);
        }
        throw new Exception('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function getAuth()
    {
        $this->debug(__METHOD__);
        $code = $_GET['code'];
        if (!$this->getAccessToken() && '' == $code) {
            $auth_url = $this->client->getAuthURL($this->callback_uri);
            return $this->redirect($auth_url);
        }
        $this->setAuth();
    }

    public function setAuth()
    {
        $this->debug(__METHOD__);
        $code = $_GET['code'];
        if ('' == $code) {
            $this->getAuth();
        }
        $params = array('code' => $code,
            'redirect_uri' => $this->callback_uri
            );
        $response = $this->client->getAccessToken($params);
        if (!$response['result'] or 200 != $response['code']) {
            throw new Exception($response['result']['error_description'], PixAPIException::AUTH_ERROR);
        }
        $this->setTokenExpires();
        $this->setToken($response['result']['access_token'], $response['result']['refresh_token']);
        return $this->access_token;
    }

    public function checkAuth()
    {
        $this->debug(__METHOD__);
        $this->setSession('callback', $_SERVER['REQUEST_URI']);
        if (!$this->getAccessToken()) {
            return false;
        }
        return true;
    }

    public function refreshAuth()
    {
        $this->debug(__METHOD__);
        if ('' == $this->getRefreshToken()) {
            throw new Exception('refresh auth fail', PixAPIException::AUTH_ERROR);
        }
        $response = $this->client->refreshAccessToken($this->getRefreshToken());
        if (!$response['result'] or 200 != $response['code']) {
            throw new Exception($response['result']['error_description'], PixAPIException::AUTH_ERROR);
        }
        $this->setTokenExpires();
        $this->setToken($response['result']['access_token'], $response['result']['refresh_token']);
        return $this->access_token;
    }

    /**
     * setCurlOption 設定單一curl選項
     *
     * @param string  $token
     * @param string  $value
     * @return void
     */
    public function setCurlOption($option, $value)
    {
        $this->debug(__METHOD__);
        $this->client->setCurlOption($option, $value);
    }

    /**
     * setCurlOptions 設定多個curl選項
     *
     * @param array  $options
     * @return void
     */
    public function setCurlOptions($options)
    {
        $this->debug(__METHOD__);
        $this->client->setCurlOptions($options);
    }

    /**
     * getAccessToken
     *
     * @return the access token
     */
    public function getAccessToken()
    {
        $this->debug(__METHOD__);
        if ('' != $this->getSession('access_token')) {
            if ($this->isTokenExpires()) {
                return $this->refreshAuth();
            }
            $this->setToken($this->getSession('access_token'), $this->getSession('refresh_token'));
        }
        return $this->access_token;
    }

    /**
     * setToken
     *
     * @param string $token Set the access token and refresh_token
     * @return void
     */
    public function setToken($access_token, $refresh_token)
    {
        $this->debug(__METHOD__);
        if ('' == $access_token or '' == $refresh_token) {
            return false;
        }
        $this->client->setAccessToken($access_token);
        $this->access_token = $access_token;
        $this->refresh_token = $refresh_token;
        $this->setSession('access_token', $access_token);
        $this->setSession('refresh_token', $refresh_token);
    }

    /**
     * getRefreshToken
     *
     * @return string refresh token
     */
    public function getRefreshToken()
    {
        $this->debug(__METHOD__);
        if ('' != $this->getSession('refresh_token')) {
            $this->setToken($this->getSession('access_token'), $this->getSession('refresh_token'));
        }
        return $this->refresh_token;
    }

    public function isTokenExpires()
    {
        $this->debug(__METHOD__);
        // return true;
        return $this->getTokenExpires() < time();
    }

    public function getTokenExpires()
    {
        $this->debug(__METHOD__);
        return intval($this->getSession('access_token_expires'));
    }

    public function setTokenExpires()
    {
        $this->debug(__METHOD__);
        $this->setSession('access_token_expires', time() + 3500);
    }

    public function query($api, $parameters = array(), $method = 'GET', $http_headers = array())
    {
        $this->debug(__METHOD__);
        if (!$this->checkAPIMethod($api)) {
            throw new Exception('API [' . $api . '] NOT FOUND', PixAPIException::API_NOT_FOUND);
        }
        $url = self::PIXNET_API . $api;
        $response = $this->client->query($url, $parameters, $method, $http_headers, true);
        if (!$response['result'] or 200 != $response['code'] or 0 < $response['result']['error']) {
            if (!isset($response['result']['message'])) {

                throw new Exception(serialize($response), PixAPIException::API_ERROR);
            }
            throw new Exception($response['result']['message'], PixAPIException::API_ERROR);
        }
        return $response['result'];
    }

    public function getSession($key)
    {
        $this->debug(__METHOD__, $key);
        if (isset($_SESSION[self::SESSION_NAME][$key])) {
            return $_SESSION[self::SESSION_NAME][$key];
        }
        return '';
    }

    public function setSession($key, $value)
    {
        $this->debug(__METHOD__, $key);
        $_SESSION[self::SESSION_NAME][$key] = $value;
        return $this->getSession($key);
    }

    public function checkAPIMethod($api)
    {
        $this->debug(__METHOD__);
        $apilist = self::getAPIList();

        $apis = explode('/', $api);
        if (count($apis) > 2) {
            $api = $apis[0] . '/' . $apis[1];
        }
        if (in_array($api, $apilist)) {
            return true;
        }
        return false;
    }

    public function redirect($url)
    {
        $this->debug(__METHOD__);
        ob_clean();
        header('Location: ' . $url);
        die('Redirect');
    }

    public function getResult($response, $key)
    {
        $this->debug(__METHOD__);
        if (isset($response[$key])) {
            return $response[$key];
        }
        return false;
    }

    public function getUserName($cache = true)
    {
        $this->debug(__METHOD__);
        $username = $this->getSession('username');
        if ('' != $username and $cache) {
            return $username;
        }
        $user = $this->getResult($this->query('account'), 'account');
        $username = $user['name'];
        $this->setSession('username', $username);
        return $uusername;
    }

    public function mergeParameters($parameters, $options, $int_fileds = array(), $str_fileds = array())
    {
        if (is_array($int_fileds)) {
            foreach ($int_fileds as $key) {
                if (isset($options[$key])) {
                    $parameters[$key] = intval($options[$key]);
                }
            }
        }
        if (is_array($str_fileds)) {
            foreach ($str_fileds as $key) {
                if (isset($options[$key])) {
                    $parameters[$key] = strval($options[$key]);
                }
            }
        }
        return $parameters;
    }

    public function debug($method, $params = '')
    {
        if ($this->debugmode) {
            echo $method . ' : ' . $params . '<br>';
        }
    }

    public static function getAPIList()
    {
        return array(
            'index/rate',
            'index/now',
            'account',
            'users',
            'blog',
            'blog/categories',
            'blog/articles',
            'blog/comments',
            'blog/site_categories',
            'album/main',
            'album/setfolders',
            'album/sets',
            'album/folders',
            'album/elements',
            'album/set_comments',
            'album/comments',
            'album/faces',
            'album/config',
            'album/site_categories',
            'friend/groups',
            'friendships',
            'friendships/append_group',
            'friendships/remove_group',
            'friendships/delete',
            'friend/news',
            'friend/subscriptions',
            'friend/subscription_groups',
            'blocks',
            'blocks/create',
            'blocks/delete',
            'guestbook',
            'mainpage/blog',
            'mainpage/album',
        );
    }
}
