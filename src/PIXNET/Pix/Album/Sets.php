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
    public function getUserSets($user, $options = array())
    {
        if (empty($user)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $user),
            $options,
            array(),
            array()
        );
        $response = $this->query('album/sets', $parameters, 'GET');
        return $this->getResult($response, 'sets');
    }
}
