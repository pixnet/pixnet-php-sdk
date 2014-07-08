<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Album_Elements_Comments extends Pix_Comments
{
    public function __construct($client)
    {
        $this->client = $client;
        $this->setApiPath('album/comments');
    }

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }
}
