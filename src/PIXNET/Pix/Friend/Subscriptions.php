<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Friend_Subscriptions extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function search($options = array())
    {
        if (!is_array($options)) {
            $parameters = $this->mergeParameters(
                array(),
                $options,
                array('page', 'per_page'),
                array()
            );
            $response = $this->query('friend/subscriptions/' . $options, $parameters, 'GET');
            return $response;
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('page', 'per_page'),
            array()
        );

        $response = $this->query('friend/subscriptions', $parameters, 'GET');
        return $response;
    }
}
