<?php
ob_start();
session_start();

$pixapi = new PixAPI(array(
  'key'  => '',
  'secret' => '',
  'callback' => ''
));