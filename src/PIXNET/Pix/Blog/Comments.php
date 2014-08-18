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

    public function search($options = array())
    {
        if (!is_array($options) and "" != $options and !is_numeric($options)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        if (!is_array($options)) {
            $parameters = array($options);
            $response = $this->query('blog/comments', $parameters, 'URI');
            return $this->getResult($response, 'comment');
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('article_id', 'page', 'per_page'),
            array('blog_password', 'article_password', 'filter', 'sort')
        );
        $response = $this->query('blog/comments', $parameters, 'GET');

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
        $response = $this->query('blog/comments', $parameters, 'POST');
        return $this->getResult($response, 'comment');
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
        $response = $this->query('blog/comments' . '/' . $comment_id . '/reply', $parameters, 'POST');
        return $this->getResult($response, 'comment');
    }
}
