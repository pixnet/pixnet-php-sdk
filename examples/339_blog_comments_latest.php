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
    <h1 class="page-header">列出文章最新留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->comments->latest($options = array());</pre>
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/blogComments" target="blank">Options說明</a></div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <h3>執行</h3>
    <pre>$pixapi->blog->comments->latest();</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->comments->latest()); ?></pre>
</div>
</body>
</html>
