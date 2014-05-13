<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

class PixAPIException extends Exception
{
    const CONFIG_MISSING                     = 0x0001;
    const CURL_NOT_FOUND                     = 0x0101;
    const CURL_ERROR                         = 0x0102;
    const JSON_NOT_FOUND                     = 0x0201;
    const SESSION_MISSING                    = 0x0301;
    const API_NOT_FOUND                      = 0x0401;
    const API_ERROR                          = 0x0402;
    const CLASS_NOT_FOUND                    = 0x0501;
    const REQUIRE_PARAMS_AS_ARRAY            = 0x9801;
    const REQUIRE_PARAMETERS_MISSING         = 0x9802;
    const AUTH_ERROR                         = 0x9901;
}
