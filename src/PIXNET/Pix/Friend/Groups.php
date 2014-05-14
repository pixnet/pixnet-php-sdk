<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Friend_Groups extends PixAPI
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
            array('page', 'per_page'),
            array()
        );

        $response = $this->query('friend/groups', $parameters, 'GET');
        return $response;
    }
}
