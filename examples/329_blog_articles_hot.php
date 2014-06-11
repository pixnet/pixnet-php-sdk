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
    <h1 class="page-header">列出部落格熱門文章</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->articles->hot($options = array());</pre>
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/blogArticlesHot" target="blank">Options說明</a></div>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->articles->hot(array('limit' => 1))); ?></pre>
</div>
</body>
</html>
