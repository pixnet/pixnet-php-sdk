<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

abstract class Pix_Comments extends PixAPI
{
    private $api_path = '';

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

    public function search($options = array())
    {
        var_dump($this->api_path);
        if (!is_array($options)) {
            $parameters = array($options);
            $response = $this->query($this->api_path, $parameters, 'URI');
            return $response;
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('article_id', 'page', 'per_page'),
            array('blog_password', 'article_password', 'filter', 'sort')
        );
        $response = $this->query($this->api_path, $parameters, 'GET');

        return $this->getResult($response, 'comments');
    }

    public function create($user, $article_id, $body, $options = array())
    {
        if ('' == $article_id or '' == $body or '' == $user) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('article_id' => $article_id, 'body' => $body, 'user' => $user),
            $options,
            array('is_open'),
            array('author', 'title', 'url', 'email', 'blog_password', 'article_password')
        );
        $response = $this->query($this->api_path, $parameters, 'POST');
        return $response;
    }

    public function reply($comment_id, $body, $options = array())
    {
        if ('' == $comment_id or '' == $body) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('body' => $body),
            $options,
            array(),
            array()
        );
        $response = $this->query($this->api_path . '/' . $comment_id . '/reply', $parameters, 'POST');
        return $response;
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
        return $response;
    }

    public function close($comment_id)
    {
        if ('' == $comment_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query($this->api_path . '/' . $comment_id . '/close', array(), 'POST');
        return $response;
    }

    public function markSpam($comment_id)
    {
        if ('' == $comment_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query($this->api_path . '/' . $comment_id . '/mark_spam', array(), 'POST');
        return $response;
    }

    public function markHam($comment_id)
    {
        if ('' == $comment_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query($this->api_path . '/' . $comment_id . '/mark_ham', array(), 'POST');
        return $response;
    }

    public function latest()
    {
        $response = $this->query($this->api_path . '/latest', array(), 'GET');
        return $response;
    }
}
