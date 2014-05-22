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
            array(),
            array('cursor', 'cursor_name', 'bidirectional')
        );

        $response = $this->query('friendships', $parameters, 'GET');
        return $response;
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
        return $response;
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
        return $response;
    }

    public function removeGroup($group_id, $name)
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
        return $response;
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
