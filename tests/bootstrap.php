<?php
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    trigger_error('you need run composer install first', E_USER_ERROR);
}
require_once(__DIR__ . '/../vendor/autoload.php');
