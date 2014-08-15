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

    public function create($name, $element_id, $body, $options = [])
    {
        if (empty($name) or empty($element_id) or empty($body)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $name, 'element_id' => $element_id, 'body' => $body),
            $options,
            array(),
            array('password')
        );
        $response = $this->query('album/comments', $parameters, 'POST');
        return $this->getResult($response, 'comment');
    }

    public function search($name, $data, $options = [])
    {
        if (empty($name)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            ['user' => $name],
            $options,
            array('element_id', 'set_id'),
            array('password')
        );
        if (!isset($data['comment_id'])) {
            $response = $this->query('album/comments', $parameters, 'GET');
            return $this->getResult($response, 'comments');
        } else {
            $response = $this->query('album/comments/' . $data['comment_id'], $parameters, 'GET');
            return $this->getResult($response, 'comment');
        }
    }
}
