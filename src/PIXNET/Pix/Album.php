<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Album extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        $class_name = strtolower($class_name);
        $class_list = array(
                'folders' => 'Pix_Album_Folders',
                'sets' => 'Pix_Album_Sets',
                'setfolders' => 'Pix_Album_SetFolders',
                'articles' => 'Pix_Album_Articles',
                'elements' => 'Pix_Album_Elements',
                'comments' => 'Pix_Album_Comments',
                'elementcomments' => 'Pix_Album_ElementComments',
                'faces' => 'Pix_Album_Faces',
            );
        $class = $class_list[$class_name];
        if ('' != $class) {
            return new $class($this->client);
        }
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function main()
    {
        $response = $this->query('album/main');
        return $response;
    }

    public function siteCategories()
    {
        $response = $this->query('album/site_categories');
        return $this->getResult($response, 'categories');
    }

    public function config()
    {
        $response = $this->query('album/config');
        return $response;
    }
}
