<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Blog_Comments extends Pix_Comments
{
    public function __construct($client)
    {
        $this->client = $client;
        $this->setApiPath('blog/comments');
    }
}
