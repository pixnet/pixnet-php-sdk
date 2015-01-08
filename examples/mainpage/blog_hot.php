<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/../include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/../include/top.php'); ?>
    <h1 class="page-header">列出全站熱門文章</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->blog->hot($category_id, $options);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->mainpage->blog->hot(1)); ?></pre>
    <h1 class="page-header">列出全站最新文章</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->blog->latest($category_id, $options);</pre>
    <h1 class="page-header">列出全站近期熱門文章</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->blog->hotWeekly($category_id, $options);</pre>
</div>
</body>
</html>
