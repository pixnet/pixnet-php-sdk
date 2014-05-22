<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Guestbook extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function search($options = array())
    {
       if (!is_array($options)) {
            $parameters = array($options);
            $response = $this->query('guestbook', $parameters, 'URI');
            return $response;
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('filter', 'cursor'),
            array('per_page')
        );

        $response = $this->query('guestbook', $parameters, 'GET');
        return $response;
    }
}
