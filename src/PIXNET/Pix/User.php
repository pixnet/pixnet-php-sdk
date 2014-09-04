<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_User extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function info($username = '')
    {
        if ('' == $username) {
            $response = $this->query('account');
            return $this->getResult($response, 'account');
        }
        $response = $this->query('users', array($username), 'URI');
        return $this->getResult($response, 'user');
    }

    public function isVip($cache = true)
    {
        $this->debug(__METHOD__);
        $is_vip = $this->getSession('is_vip');
        if ('' != $is_vip and $cache) {
            return $is_vip;
        }
        $response = $this->query('account');
        $is_vip = $this->getResult($response, 'account')['data']['is_vip'];
        $this->setSession('is_vip', $is_vip);
        return $is_vip;
    }
}
