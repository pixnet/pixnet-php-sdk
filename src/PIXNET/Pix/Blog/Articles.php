<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Blog_Articles extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function search($options = [])
    {
        if (is_numeric($options)) {
            $parameters = $this->mergeParameters(
                array(),
                $options,
                array(),
                array('blog_password')
            );
            $response = $this->query('blog/articles/' . $options, $parameters, 'GET');
            return $this->getResult($response, 'article');
        }

        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('page', 'per_page', 'category_id', 'status', 'is_top', 'trim_user'),
            array('blog_password')
        );
        $response = $this->query('blog/articles', $parameters, 'GET');

        return $this->getResult($response, 'articles');
    }

    public function related($article_id, $options = array())
    {
        if ('' == $article_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('with_body', 'limit'),
            array()
        );
        $response = $this->query('blog/articles/' . $article_id . '/related', $parameters, 'GET');

        return $this->getResult($response, 'articles');
    }

    public function comments($article_id, $options = array())
    {
        if ('' == $article_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('page', 'per_page'),
            array('blog_password', 'article_password', 'filter', 'sort')
        );
        $response = $this->query('blog/articles/' . $article_id . '/comments', $parameters, 'GET');

        return $this->getResult($response, 'comments');
    }

    public function create($title, $body, $options = array())
    {
        if ('' == $title or '' == $body) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('title' => $title, 'body' => $body),
            $options,
            array('status','public_at','category_id','site_category_id','use_nl2br','comment_perm','comment_hidden'),
            array('tags','thumb','trackback','password','password_hint','friend_group_ids','notify_twitter','notify_facebook')
        );
        $response = $this->query('blog/articles', $parameters, 'POST');
        return $this->getResult($response, 'article');
    }

    public function update($article_id, $title, $body, $options = array())
    {
        if ('' == $title or '' == $body) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('title' => $title, 'body' => $body),
            $options,
            array('status','public_at','category_id','site_category_id','use_nl2br','comment_perm','comment_hidden'),
            array('tags','thumb','trackback','password','password_hint','friend_group_ids','notify_twitter','notify_facebook')
        );
        $response = $this->query('blog/articles/' . $article_id, $parameters, 'POST');
        return $this->getResult($response, 'article');
    }

    public function delete($article_id, $is_folder = false)
    {
        if ('' == $article_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query('blog/articles/' . $article_id, array(), 'DELETE');
        return $response;
    }

    public function latest($options = array())
    {
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('limit', 'trim_user'),
            array('blog_password')
        );

        $response = $this->query('blog/articles/latest', $parameters, 'GET');
        return $this->getResult($response, 'articles');
    }

    public function hot($options = array())
    {
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('limit', 'trim_user'),
            array('blog_password')
        );

        $response = $this->query('blog/articles/hot', $parameters, 'GET');
        return $this->getResult($response, 'articles');
    }
}
