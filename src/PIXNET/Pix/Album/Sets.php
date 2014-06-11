<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Album_Sets extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * search
     *
     * @param string $user
     * @param array $options
     * @return void
     */
    public function search($name, $set_id = null, $options = array())
    {
        if (empty($name)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }

        $parameters = $this->mergeParameters(
            array('user' => $name),
            $options,
            array('parent_id', 'trim_user', 'page', 'per_page'),
            array()
        );
        if (empty($set_id)) {
            $response = $this->query('album/sets', $parameters, 'GET');
            return $this->getResult($response, 'sets');
        } else {
            $response = $this->query('album/sets/' . $set_id, $parameters, 'GET');
            return $this->getResult($response, 'set');
        }
    }

    public function elements($name, $set_id, $options = array())
    {
        if (empty($set_id) or empty($name)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $name, 'set_id' => $set_id),
            $options,
            array('page', 'per_page', 'with_detail', 'trim_user', 'iframe_width', 'iframe_height'),
            array('type', 'password', 'use_iframe')
        );
        $response = $this->query('album/elements', $parameters, 'GET');
        return $this->getResult($response, 'elements');
    }

    public function comments($name, $set_id, $options = array())
    {
        if (empty($set_id) or empty($name)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $name, 'set_id' => $set_id),
            $options,
            array('page', 'per_page'),
            array('password')
        );
        $response = $this->query('album/set_comments', $parameters, 'GET');
        return $this->getResult($response, 'comments');
    }

    public function nearby($name, $lat, $lon, $options = array())
    {
        if (empty($name) or empty($lat) or empty($lon)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $name, 'lat' => $lat, 'lon' => $lon),
            $options,
            array('page', 'per_page', 'trim_user', 'distance_max', 'distance_min'),
            array()
        );
        $response = $this->query('album/sets/nearby', $parameters, 'GET');
        return $this->getResult($response, 'sets');
    }

    public function create($title, $desc, $options = array())
    {
        if (empty($title) or empty($desc)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('title' => $title, 'description' => $desc),
            $options,
            array('permission', 'category_id', 'is_lockright', 'allow_cc', 'cancomment', 'allow_commercial_usr', 'allow_derivation', 'parent_id'),
            array('password', 'password_hint', 'friend_group_ids')
        );
        $response = $this->query('album/sets', $parameters, 'POST');
        return $this->getResult($response, 'set');
    }

    public function update($set_id, $title, $desc, $options = array())
    {
        if (empty($set_id) or empty($title) or empty($desc)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('title' => $title, 'description' => $desc),
            $options,
            array('permission', 'category_id', 'is_lockright', 'allow_cc', 'cancomment', 'allow_commercial_usr', 'allow_derivation', 'parent_id'),
            array('password', 'password_hint', 'friend_group_ids')
        );
        $response = $this->query('album/sets/' . $set_id, $parameters, 'POST');
        return $this->getResult($response, 'set');
    }

    public function position($parent_id, $ids, $options = array())
    {
        if ('' == $parent_id or empty($ids)) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('parent_id' => $parent_id, 'ids' => $ids),
            $options,
            array(),
            array()
        );
        $response = $this->query('album/sets/position', $parameters, 'POST');
        return $this->getResult($response, 'sets');
    }

    public function delete($set_id, $options = array())
    {
        if ('' == $set_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array(),
            $options,
            array(),
            array()
        );
        $response = $this->query('album/sets/' . $set_id, $parameters, 'DELETE');
        return $response;
        return $this->getResult($response, 'sets');
    }
}
