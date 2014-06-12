<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Album_SetFolders extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function search($name, $options = array())
    {
        $parameters = $this->mergeParameters(
            array('user' => $name),
            $options,
            array('trim_user', 'page', 'per_page'),
            array()
        );
        $response = $this->query('album/setfolders', $parameters, 'GET');
        return $this->getResult($response, 'setfolders');
    }
}
