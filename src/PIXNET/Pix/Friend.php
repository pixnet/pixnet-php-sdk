<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Friend extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        $class_name = strtolower($class_name);
        $class_list = array(
                'groups' => 'Pix_Friend_Groups',
                'friendships' => 'Pix_Friend_Friendships',
                'subscriptions' => 'Pix_Friend_Subscriptions',
                'subscriptionGroups' => 'Pix_Friend_SubscriptionGroups'
            );
        $class = $class_list[$class_name];
        if ('' != $class) {
            return new $class($this->client);
        }
        throw new Exception('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function news($options = array())
    {
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('group_id', 'before_time'),
            array('group_type')
        );

        $response = $this->query('friend/news', $parameters, 'GET');
        return $response;
    }

}
