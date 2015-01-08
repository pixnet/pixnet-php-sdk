<?php
require_once(__DIR__ . '/../../src/Loader.php');
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
    <h1 class="page-header">列出文章專欄</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->blog->columns();</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->mainpage->blog->columns()); ?></pre>
    <h1 class="page-header">列出文章專欄分類</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->blog->columnsCategory();</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->mainpage->blog->columnsCategory()); ?></pre>
    <h1 class="page-header">列出分類文章專欄</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->mainpage->blog->columns($category_id, $options);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>category_id</p><p>分類 id</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>page</p><p>頁數，一頁20篇文章</p></li>
        </ul>
    </div>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->mainpage->blog->columns(1)); ?></pre>
</div>
</body>
</html>
