<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class Pix_Album_Faces extends PixAPI
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function __get($class_name)
    {
        throw new PixAPIException('CLASS [' . $class_name . '] NOT FOUND', PixAPIException::CLASS_NOT_FOUND);
    }

    public function create($user, $element_id, $x, $y, $w, $h)
    {
        if ('' == $user or '' == $element_id or '' == $x or '' == $y or '' == $w or '' == $h) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $user, 'element_id' => $element_id, 'x' => $x, 'y' => $y, 'w' => $w, 'h' => $h),
            $options,
            array(),
            array()
        );
        $response = $this->query('album/faces', $parameters, 'POST');
        return $this->getResult($response, 'element');
    }

    public function createByRecommendId($user, $recommend_id, $options = array())
    {
        if ('' == $user or '' == $recommend_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $user, 'recommend_id' => $recommend_id),
            $options,
            array(),
            array()
        );
        $response = $this->query('album/faces', $parameters, 'POST');
        return $response;
    }

    public function update($face_id, $user, $element_id, $x, $y, $w, $h)
    {
        if ('' == $user or '' == $element_id or '' == $x or '' == $y or '' == $w or '' == $h) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $parameters = $this->mergeParameters(
            array('user' => $user, 'element_id' => $element_id, 'x' => $x, 'y' => $y, 'w' => $w, 'h' => $h),
            $options,
            array(),
            array()
        );
        $response = $this->query('album/faces/' . $face_id, $parameters, 'POST');
        return $response;
    }

    public function delete($face_id)
    {
        if ('' == $face_id) {
            throw new PixAPIException('Required parameters missing', PixAPIException::REQUIRE_PARAMETERS_MISSING);
        }
        $response = $this->query('album/faces/' . $face_id, array(), 'DELETE');
        return $response;
    }
}
