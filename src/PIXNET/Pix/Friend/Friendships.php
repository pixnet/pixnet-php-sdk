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

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function search($options = array())
    {
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array(),
            array('cursor', 'cursor_name', 'bidirectional')
        );

        $response = $this->query('friendships', $parameters, 'GET');
        return $this->getResult($response, 'friend_pairs');
    }

    public function create($name)
    {
        if ('' == $name) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user_name' => $name),
            $options,
            array(),
            array()
        );
        $response = $this->query('friendships', $parameters, 'POST');
        return $this->getResult($response, 'friend_pair');
    }

    public function appendGroup($name, $group_id)
    {
        if ('' == $name or '' == $group_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user_name' => $name, 'group_id' => $group_id),
            $options,
            array(),
            array()
        );
        $response = $this->query('friendships/append_group', $parameters, 'POST');
        return $this->getResult($response, 'friend_pair');
    }

    public function removeGroup($name, $group_id)
    {
        if ('' == $group_id or '' == $name) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('group_id' => $group_id, 'user_name' => $name),
            $options,
            array(),
            array()
        );
        $response = $this->query('friendships/remove_group', $parameters, 'DELETE');
        return $this->getResult($response, 'friend_pair');
    }

    public function delete($name)
    {
        if ('' == $name) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user_name' => $name),
            $options,
            array(),
            array()
        );
        $response = $this->query('friendships/delete', $parameters, 'DELETE');
        return $response;
    }
}
