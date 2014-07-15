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

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
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
            return $this->getResult($response, 'subscription_group');
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array(),
            array()
        );

        $response = $this->query('friend/subscription_groups', $parameters, 'GET');
        return $this->getResult($response, 'subscription_groups');
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
        return $this->getResult($response, 'subscription_group');
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
        return $this->getResult($response, 'subscription_group');
    }

    public function delete($group_id)
    {
        if ('' == $group_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array(),
            array()
        );
        $response = $this->query('friend/subscription_groups/' . $group_id, $parameters, 'DELETE');
        return $response;
    }

    public function position($group_ids)
    {
        if ('' == $group_ids) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('ids' => $group_ids),
            $options,
            array(),
            array()
        );
        $response = $this->query('friend/subscription_groups/position', $parameters, 'POST');
        return $this->getResult($response, 'subscription_groups');
    }
}
