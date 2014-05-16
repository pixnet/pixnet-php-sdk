<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Friend_Friendships extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function search($options = array())
    {
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('cursor', 'cursor_name', 'bidirectional'),
            array()
        );

        $response = $this->query('friendships', $parameters, 'GET');
        return $response;
    }
}
