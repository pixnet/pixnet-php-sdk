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

    public function search($name, $options = [])
    {
        if ((empty($options['set_id']) and empty($options['element_id'])) or empty($name)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        if (isset($options['set_id'])) {
            $parameters = $this->mergeParameters(
                ['set_id' => $options['set_id'], 'user' => $name],
                $options,
                ['page', 'per_page', 'with_detail', 'trim_user', 'iframe_width', 'iframe_heigh'],
                ['type', 'password', 'use_iframe']
            );
            $response = $this->query('album/elements', $parameters, 'GET');
            return $this->getResult($response, 'elements');
        } else {
            $parameters = $this->mergeParameters(
                ['user' => $name],
                $options,
                ['page', 'per_page', 'with_detail', 'trim_user', 'iframe_width', 'iframe_heigh'],
                ['type', 'password', 'use_iframe']
            );
            $response = $this->query('album/elements/' . $options['element_id'], $parameters, 'GET');
            return $this->getResult($response, 'elements');
        }
    }

    public function update($element_id, $options = [])
    {
        if (empty($element_id)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            [],
            $options,
            ['set_id'],
            ['title', 'description', 'tags', 'latitude', 'longitude', 'video_thumb_type']
        );
        $response = $this->query('album/elements/' . $element_id, $parameters, 'POST');
        return $this->getResult($response, 'elements');
    }

    public function delete($element_id)
    {
        if (empty($element_id)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query('album/elements/' . $element_id, [], 'DELETE');
        return $this->getResult($response, 'elements');
    }
}
