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
    <hr>
    <div class="well">
        <p>選填參數</p>
        <ul>
        <li><p>page</p><p>指定頁數，預設為1</p></li>
        <li><p>per_page</p><p>一頁回傳幾筆, 預設為10</p></li>
        </ul>
    </div>
    <h1 class="page-header">列出全站熱門影片</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->video->hot($options);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->mainpage->video->hotWeekly()); ?></pre>
    <h1 class="page-header">列出全站最新影片</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->video->latest($options);</pre>
    <h1 class="page-header">列出全站近期熱門影片</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->video->hotWeekly($options);</pre>
</div>
</body>
</html>
