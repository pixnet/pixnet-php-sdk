<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Block extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function search()
    {
        $response = $this->query('blocks');
        return $this->getResult($response, 'blocks');

    }

    public function create($user)
    {
        if ('' == $user) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = array('user' => $user);
        $response = $this->query('blocks', $parameters, 'POST');
        return $response;
    }

    public function delete($user)
    {
        if ('' == $user) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = array('user' => $user);
        $response = $this->query('blocks/delete', $parameters, 'DELETE');
        return $response;
    }
}
