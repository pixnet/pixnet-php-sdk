<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Album_Elements extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        $class_name = strtolower($class_name);
        $class_list = array(
                'comments' => 'Pix_Album_Elements_Comments'
            );
        $class = $class_list[$class_name];
        if ('' != $class) {
            return new $class($this->client);
        }
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function create($set_id, $tmp_file_name, $options = [])
    {
        if (empty($set_id) or !file_exists($tmp_file_name)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $default_setting = ['upload_method' => 'base64'];
        $options = array_merge($options, $default_setting);
        $parameters = $this->mergeParameters(
            ['set_id' => $set_id, 'upload_file' => base64_encode(file_get_contents($tmp_file_name))],
            $options,
            [],
            ['title', 'description', 'tags', 'latitude', 'longitude', 'video_thumb_type', 'optimized_size', 'rotate_by_exif', 'rotate_by_meta', 'quadrate', 'add_watermark', 'element_first', 'upload_method']
        );
        $response = $this->query('album/elements', $parameters, 'POST');
        return $this->getResult($response, 'element');
    }
}
