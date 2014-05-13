<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Index extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function rate()
    {
        return $this->query('index/rate');
    }

    public function now()
    {
        $response = $this->query('index/now');
        return $this->getResult($response, 'now');
    }
}
