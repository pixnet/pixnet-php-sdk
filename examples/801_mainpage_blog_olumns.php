<?php
require_once(__DIR__ . '/../src/Loader.php');
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
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/mainpageBlogColumns" target="blank">Options說明</a></div>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->mainpage->blog->columns(1)); ?></pre>
</div>
</body>
</html>
