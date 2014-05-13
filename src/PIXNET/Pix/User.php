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

    public function info($username = '')
    {
        if ('' == $username) {
            $response = $this->query('account');
            return $this->getResult($response, 'account');
        }
        $response = $this->query('users', array($username), 'URI');
        return $this->getResult($response, 'user');
    }
}
