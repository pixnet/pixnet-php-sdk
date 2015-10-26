<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_User_Notifications extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function search($options = array())
    {
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('skip_set_read', 'limit'),
            array('type')
        );

        $response = $this->query('account/notifications', $parameters, 'GET');
        return $this->getResult($response, 'notifications');
    }

    public function markRead($id = '')
    {
        if (!is_int($id)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query('account/notifications/' . $id . '/read', array(), 'POST');
        return $this->getResult($response, 'notifications');
    }
}
