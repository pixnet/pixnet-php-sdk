<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Mainpage_Blog extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }


    public function columns($category_id = '', $options = array())
    {
        if ('' == $category_id) {
            $response = $this->query('mainpage/blog/columns');
            return $response;
        }

        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('page'),
            array()
        );
        $response = $this->query('mainpage/blog/columns/' . $category_id, $parameters, 'GET');
        return $this->getResult($response, 'posts');
    }

    public function columnsCategory()
    {
        $response = $this->query('mainpage/blog/columns/categories');
        return $this->getResult($response, 'categories');
    }

    public function hot($category_id, $options = array())
    {
        if ('' == $category_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }

        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('page', 'count'),
            array()
        );
        $response = $this->query('mainpage/blog/categories/hot/' . $category_id, $parameters, 'GET');
        return $response;
    }

    public function latest($category_id, $options = array())
    {
        if ('' == $category_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }

        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('page', 'count'),
            array()
        );
        $response = $this->query('mainpage/blog/categories/latest/' . $category_id, $parameters, 'GET');
        return $response;
    }

    public function hot_weekly($category_id, $options = array())
    {
        if ('' == $category_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }

        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('page', 'count'),
            array()
        );
        $response = $this->query('mainpage/blog/categories/hot_weekly/' . $category_id, $parameters, 'GET');
        return $response;
    }
}
