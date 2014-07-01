<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Guestbook extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
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

    public function open($guestbook_id)
    {
        if ('' == $guestbook_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query('guestbook/' . $guestbook_id . '/open', array(), 'POST');
        return $response;
    }

    public function close($guestbook_id)
    {
        if ('' == $guestbook_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query('guestbook/' . $guestbook_id . '/close', array(), 'POST');
        return $response;
    }

    public function markSpam($guestbook_id)
    {
        if ('' == $guestbook_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query('guestbook/' . $guestbook_id . '/mark_spam', array(), 'POST');
        return $response;
    }

    public function markHam($guestbook_id)
    {
        if ('' == $guestbook_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query('guestbook/' . $guestbook_id . '/mark_ham', array(), 'POST');
        return $response;
    }

    public function delete($guestbook_id)
    {
        if ('' == $guestbook_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query('guestbook/' . $guestbook_id, array(), 'DELETE');
        return $response;
    }
}
