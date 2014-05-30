<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class PixClient
{
    const ACCESS_TOKEN_URL = 'https://emma.pixnet.cc/oauth2/authorize';
    const AUTHORIZATION_URL = 'https://emma.pixnet.cc/oauth2/grant';
    protected $client_id = null;
    protected $client_secret = null;
    protected $access_token = null;
    protected $curl_options = array();

    /**
     * Construct
     *
     * @param string $client_id Client ID
     * @param string $client_secret Client Secret
     * @return void
     */
    public function __construct($client_id, $client_secret)
    {
        $this->client_id     = $client_id;
        $this->client_secret = $client_secret;
    }

    /**
     * getAuthURL 取得 Authorization 網址，
     *
     * @param string $redirect_uri 與設定的Callback 一致
     * @return string Authorization 網址
     */
    public function getAuthURL($redirect_uri, array $extra_parameters = array())
    {
        $parameters = array_merge(array(
            'response_type' => 'code',
            'client_id'     => $this->client_id,
            'redirect_uri'  => $redirect_uri
        ), $extra_parameters);
        return self::ACCESS_TOKEN_URL . '?' . http_build_query($parameters, null, '&');
    }

    /**
     * getAccessToken 取得Token
     *
     * @param array  $parameters
     * @return array
     */
    public function getAccessToken(array $parameters)
    {
        $http_headers = array();
        $parameters['grant_type'] = 'authorization_code';
        $parameters['client_id'] = $this->client_id;
        $parameters['client_secret'] = $this->client_secret;
        return $this->sendRequest(self::AUTHORIZATION_URL, $parameters, 'GET', $http_headers, false);
    }

    /**
     * getAccessToken 重新取得Token
     *
     * @param array  $parameters
     * @return array
     */
    public function refreshAccessToken($refresh_token)
    {
        $http_headers = array();
        $parameters['grant_type'] = 'refresh_token';
        $parameters['refresh_token'] = $refresh_token;
        $parameters['client_id'] = $this->client_id;
        $parameters['client_secret'] = $this->client_secret;
        return $this->sendRequest(self::AUTHORIZATION_URL, $parameters, 'GET', $http_headers, false);
    }

    /**
     * getAccessToken 取得Token
     *
     * @param string  $token
     * @return void
     */
    public function setAccessToken($token)
    {
        $this->access_token = $token;
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
        $this->curl_options[$option] = $value;
    }

    /**
     * setCurlOptions 設定多個curl選項
     *
     * @param array  $options
     * @return void
     */
    public function setCurlOptions($options)
    {
        if (!is_array($options)) {
            throw new PixAPIException(
                'You need to give options as array',
                PixAPIException::REQUIRE_PARAMS_AS_ARRAY
            );
        }
        foreach ($options as $key => $value) {
            $this->curl_options[$key] = $value;
        }
    }

    /**
     * query 查詢API
     *
     * @param string  $api_url
     * @param array  $parameters
     * @param array  $method    'GET' 'POST' 'DELETE'
     * @param array  $http_headers
     * @param boolean  $form_multipart
     * @return array
     */
    public function query($api_url, $parameters = array(), $method = 'GET', array $http_headers = array(), $form_multipart = true)
    {
        if (is_array($parameters)) {
            if ('URI' == $method) {
                $api_url .= '/' . implode($parameters, '/');
                $parameters = array();
                $method = 'GET';
            }
        } else {
            throw new PixAPIException(
                'You need to give parameters as array',
                PixAPIException::REQUIRE_PARAMS_AS_ARRAY
            );
        }

        if ($this->access_token) {
            $parameters['access_token'] = $this->access_token;
        }
        return $this->sendRequest($api_url, $parameters, $method, $http_headers, $form_multipart);
    }

    /**
     * sendRequest 實際送出HTTP請求
     *
     * @param string  $api_url
     * @param array  $parameters
     * @param array  $method    'GET' 'POST' 'DELETE'
     * @param array  $http_headers
     * @param boolean  $form_multipart
     * @return array
     */
    private function sendRequest($api_url, $parameters = array(), $method = 'GET', array $http_headers = null, $form_multipart = true)
    {
        $curl_options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_CUSTOMREQUEST  => $method
        );
        switch($method) {
            case 'POST':
                $curl_options[CURLOPT_POST] = true;
                if (is_array($parameters) && ! $form_multipart) {
                    $parameters = http_build_query($parameters, null, '&');
                }
                $curl_options[CURLOPT_POSTFIELDS] = $parameters;
                break;
            case 'DELETE':
            case 'GET':
                if (is_array($parameters)) {
                    $api_url .= '?' . http_build_query($parameters, null, '&');
                } elseif ($parameters) {
                    $api_url .= '?' . $parameters;
                }
                break;
            default:
                break;
        }
        $curl_options[CURLOPT_URL] = $api_url;
        if (is_array($http_headers)) {
            $header = array();
            foreach ($http_headers as $key => $parsed_urlvalue) {
                $header[] = "$key: $parsed_urlvalue";
            }
            $curl_options[CURLOPT_HTTPHEADER] = $header;
        }
        $ch = curl_init();
        curl_setopt_array($ch, $curl_options);
        if (!empty($this->curl_options)) {
            curl_setopt_array($ch, $this->curl_options);
        }
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        if ($curl_error = curl_error($ch)) {
            throw new PixAPIException($curl_error, PixAPIException::CURL_ERROR);
        } else {
            $json_decode = json_decode($result, true);
        }
        curl_close($ch);
        return array(
            'result' => (null === $json_decode) ? $result : $json_decode,
            'code' => $http_code,
            'content_type' => $content_type
        );
    }
}
