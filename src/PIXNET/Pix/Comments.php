<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

abstract class Pix_Comments extends PixAPI
{
    private $api_path = '';
    private $response_key = 'comment';

    /**
      * @codeCoverageIgnore
      */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function setApiPath($name)
    {
        $this->api_path = $name;
    }

    public function setResponseKey($key)
    {
        $this->response_key = $key;
    }

    public function delete($comment_id)
    {
        if ('' == $comment_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query($this->api_path . '/' . $comment_id, array(), 'DELETE');
        return $response;
    }

    public function open($comment_id)
    {
        if ('' == $comment_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query($this->api_path . '/' . $comment_id . '/open', array(), 'POST');
        return $this->getResult($response, $this->response_key);
    }

    public function close($comment_id)
    {
        if ('' == $comment_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query($this->api_path . '/' . $comment_id . '/close', array(), 'POST');
        return $this->getResult($response, $this->response_key);
    }

    public function markSpam($comment_id, $options = array())
    {
        if ('' == $comment_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query($this->api_path . '/' . $comment_id . '/mark_spam', array(), 'POST');
        return $this->getResult($response, $this->response_key);
    }

    public function markHam($comment_id)
    {
        if ('' == $comment_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query($this->api_path . '/' . $comment_id . '/mark_ham', array(), 'POST');
        return $this->getResult($response, $this->response_key);
    }

    public function latest()
    {
        $response = $this->query($this->api_path . '/latest', array(), 'GET');
        return $this->getResult($response, 'latest_comments');
    }
}
