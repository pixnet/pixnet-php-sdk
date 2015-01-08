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
    <h1 class="page-header">列出全站熱門相簿</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->album->hot($category_id, $options);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->mainpage->album->hot(1)); ?></pre>
    <h1 class="page-header">列出全站最新相簿</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->album->latest($category_id, $options);</pre>
    <h1 class="page-header">列出全站近期熱門相簿</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->album->hotWeekly($category_id, $options);</pre>
    <h1 class="page-header">列出全站近期精選相簿</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->album->bestSelected();</pre>
</div>
</body>
</html>
