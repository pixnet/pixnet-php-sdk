<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Album_Comments extends Pix_Comments
{
    public function __construct($client)
    {
        $this->client = $client;
        $this->setApiPath('album/set_comments');
    }

    public function create($name, $set_id, $body, $options = [])
    {
        if (empty($name) or empty($set_id) or empty($body)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $name, 'set_id' => $set_id, 'body' => $body),
            $options,
            array(),
            array('password')
        );
        $response = $this->query('album/set_comments', $parameters, 'POST');
        return $this->getResult($response, 'comment');
    }

    public function search($name, $data, $options = [])
    {
        if (empty($name) or (!isset($data['set_id']) and !isset($data['comment_id']))) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        if (isset($data['set_id'])) {
            $data['user'] = $name;
            $query_uri = 'album/set_comments';
        } else {
            $query_uri = 'album/set_comments/' . $data['comment_id'];
            $data = ['user' => $name];
        }
        $parameters = $this->mergeParameters(
            $data,
            $options,
            array(),
            array('password')
        );
        $response = $this->query($query_uri, $parameters, 'GET');
        if (isset($data['set_id'])) {
            return $this->getResult($response, 'comments');
        } else {
            return $this->getResult($response, 'comment');
        }
    }
}
