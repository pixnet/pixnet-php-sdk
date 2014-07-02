<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Mainpage_Video extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function hot($options = array())
    {
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('page', 'per_page'),
            array()
        );
        $response = $this->query('mainpage/album/video/hot/', $parameters, 'GET');
        return $response;
    }

    public function latest($options = array())
    {
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('page', 'per_page'),
            array()
        );
        $response = $this->query('mainpage/album/video/latest/', $parameters, 'GET');
        return $response;
    }

    public function hotWeekly($options = array())
    {
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('page', 'per_page'),
            array()
        );
        $response = $this->query('mainpage/album/video/hot_weekly/', $parameters, 'GET');
        return $response;
    }
}
