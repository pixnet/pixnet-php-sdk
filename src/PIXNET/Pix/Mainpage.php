<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Mainpage extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        $class_name = strtolower($class_name);
        $class_list = array(
                'blog' => 'Pix_Mainpage_Blog',
                'album' => 'Pix_Mainpage_Album',
                'video' => 'Pix_Mainpage_Video'
            );
        $class = $class_list[$class_name];
        if ('' != $class) {
            return new $class($this->client);
        }
        throw new Exception('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }
}
