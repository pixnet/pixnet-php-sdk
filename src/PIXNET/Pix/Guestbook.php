<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Guestbook extends Pix_Comments
{
    public function __construct($client)
    {
        $this->client = $client;
        $this->setApiPath('guestbook');
    }

    public function search($options = array())
    {
        if (!is_array($options)) {
            $parameters = array($options);
            $response = $this->query('guestbook', $parameters, 'URI');
            return $response;
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array('per_page'),
            array('filter', 'cursor')
        );

        $response = $this->query('guestbook', $parameters, 'GET');
        return $response;
    }

    public function create($username, $title, $body, $options = array())
    {
        if ('' == $username or '' == $title or '' == $body) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $username, 'title' => $title, 'body' => $body),
            $options,
            array('is_open'),
            array('author', 'url','email')
        );
        $response = $this->query('guestbook', $parameters, 'POST');
        return $response;
    }

    public function reply($guestbook_id, $body, $options = array())
    {
        if ('' == $guestbook_id or '' == $body) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('reply' => $body),
            $options,
            array(),
            array()
        );
        $response = $this->query('guestbook/' . $guestbook_id . '/reply', $parameters, 'POST');
        return $response;
    }
}
