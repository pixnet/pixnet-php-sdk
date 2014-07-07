<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Album_Comments extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function create($name, $set_id, $body, $options = [])
    {
        if (empty($name) or empty($set_id) or empty($body)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $name, 'set_id' => $set_id, 'body' => $body),
            $options,
            array(),
            array('password')
        );
        $response = $this->query('album/set_comments', $parameters, 'POST');
        return $this->getResult($response, 'comment');
    }
}
