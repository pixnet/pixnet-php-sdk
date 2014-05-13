<?php
/*
 * 此頁為設定授權，網址必須和APP中的Registered Callback URL，一致
 */
require_once(__DIR__ . '/bootstrap.php');
$pixapi->setAuth();
$callback = $pixapi->getSession('callback');
if ('' != $callback) {
    $pixapi->redirect($callback);
} else {
    $pixapi->redirect('./');
}