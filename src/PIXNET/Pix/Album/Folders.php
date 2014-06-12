<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Album_Folders extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function search($name = null, $options = null)
    {
        $parameters = $this->mergeParameters(
            array('user' => $name),
            $options,
            array('trim_user', 'page', 'per_page', 'folder_id'),
            array()
        );
        if (isset($options['folder_id']) and is_numeric($options['folder_id'])) {
            $response = $this->query('album/folders/' . $options['folder_id'], $parameters, 'GET');
            return $this->getResult($response, 'folder');
        } else {
            $response = $this->query('album/folders', $parameters, 'GET');
            return $this->getResult($response, 'folders');
        }
    }
}
