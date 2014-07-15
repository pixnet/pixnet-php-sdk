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

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
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
        return $this->getResult($response, 'elements');
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
        return $this->getResult($response, 'elements');
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
        return $this->getResult($response, 'elements');
    }
}
