<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Friend_SubscriptionGroups extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function search($group_id = '')
    {
        if ('' != $group_id) {
            $parameters = $this->mergeParameters(
                array(),
                $options,
                array(),
                array()
            );

            $response = $this->query('friend/subscription_groups/' . $group_id, $parameters, 'GET');
            return $response;
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array(),
            array()
        );

        $response = $this->query('friend/subscription_groups', $parameters, 'GET');
        return $response;
    }

    public function create($name)
    {
        if ('' == $name) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('name' => $name),
            $options,
            array(),
            array()
        );
        $response = $this->query('friend/subscription_groups', $parameters, 'POST');
        return $response;
    }

    public function update($group_id, $name)
    {
        if ('' == $group_id or '' == $name) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('name' => $name),
            $options,
            array(),
            array()
        );
        $response = $this->query('friend/subscription_groups/' . $group_id, $parameters, 'POST');
        return $response;
    }
}
