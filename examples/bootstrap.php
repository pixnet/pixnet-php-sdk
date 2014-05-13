<?php
require_once(__DIR__ . '/../src/Loader.php');
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once(__DIR__ . '/../vendor/autoload.php');
} else {
    require_once(__DIR__ . '/../src/Loader.php');
}

if (!file_exists(__DIR__ . '/init.inc.php')) {
    throw new PixAPIException(
        'You must create a init.inc.php file from init.inc.sample.php)',
        PixAPIException::CONFIG_MISSING
    );
}

require_once(__DIR__ . '/init.inc.php');