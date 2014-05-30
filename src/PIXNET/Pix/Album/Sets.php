<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Album_Sets extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * search
     *
     * @param string $user
     * @param array $options
     * @return void
     */
    public function search($name, $set_id = null, $options = array())
    {
        if (empty($name)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }

        $parameters = $this->mergeParameters(
            array('user' => $name),
            $options,
            array('parent_id', 'trim_user', 'page', 'per_page'),
            array('format')
        );
        if (empty($set_id)) {
            $response = $this->query('album/sets', $parameters, 'GET');
            return $this->getResult($response, 'sets');
        } else {
            $response = $this->query('album/sets/' . $set_id, $parameters, 'GET');
            return $this->getResult($response, 'set');
        }
    }

    public function elements($name, $set_id, $options = array())
    {
        if (empty($set_id) or empty($name)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $name, 'set_id' => $set_id),
            $options,
            array(),
            array()
        );
        $response = $this->query('album/elements', $parameters, 'GET');
        return $this->getResult($response, 'elements');
    }
}
