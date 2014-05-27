<?php
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    trigger_error('You need run composer install first', E_USER_ERROR);
}
if (!file_exists(__DIR__ . '/Authentication.php')) {
    trigger_error('You must create a Authentication.php file from Authentication.sample.php', E_USER_ERROR);
}
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/Authentication.php');
