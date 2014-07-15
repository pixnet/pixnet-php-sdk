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

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function rate()
    {
        $response = $this->query('index/rate');
        $data = ['rate' => $response['rate'],
            'authenticated' => $response['authenticated'],
            'limit' => $response['limit']];
        unset($response['rate']);
        unset($response['authenticated']);
        unset($response['limit']);
        $response['data'] = $data;
        return $response;
    }

    public function now()
    {
        $response = $this->query('index/now');
        return $this->getResult($response, 'now');
    }
}
