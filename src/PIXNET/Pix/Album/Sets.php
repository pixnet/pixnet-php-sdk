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
     * getUserSets
     *
     * @param string $user
     * @param array $options
     * @return void
     */
    public function getUserSets($name, $options = array())
    {
        if (empty($name)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $name),
            $options,
            array(),
            array()
        );
        $response = $this->query('album/sets', $parameters, 'GET');
        return $this->getResult($response, 'sets');
    }

    public function getUserSingleSet($name, $set_id, $options = array())
    {
        if (empty($set_id) or empty($name)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $name),
            $options,
            array(),
            array()
        );
        $response = $this->query('album/sets/' . $set_id, $parameters, 'GET');
        return $this->getResult($response, 'set');
    }

    public function getSetElements($name, $set_id, $options = array())
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
