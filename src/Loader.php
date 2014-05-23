<?php
/**
 * Copyright (c) 2014, PIXNET Digital Media Corporation
 * All rights reserved.
 */

call_user_func(function () {
    set_include_path(implode(PATH_SEPARATOR, array(
        get_include_path(),
        __DIR__ . "/PIXNET"
    )));
});

require(__DIR__ . '/PIXNET/PixLoader.php');
PixLoader::registerAutoload();
