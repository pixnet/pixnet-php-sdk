<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/include/top.php'); ?>
    <h1 class="page-header">列出全站熱門影片</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->video->hot($options);</pre>
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/mainpageAlbumVideo" target="blank">Options說明</a></div>
    <h1 class="page-header">列出全站最新影片</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->video->latest($options);</pre>
    <h1 class="page-header">列出全站近期熱門影片</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->video->hot_weekly($options);</pre>
</div>
</body>
</html>