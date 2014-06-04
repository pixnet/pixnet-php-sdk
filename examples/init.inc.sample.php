<?php
ob_start();
session_start();
PixAPI::setDebugMode(false); // 修改為true，可以印出執行的過程
$pixapi = new PixAPI(array(
  'key'  => '',
  'secret' => '',
  'callback' => ''
));