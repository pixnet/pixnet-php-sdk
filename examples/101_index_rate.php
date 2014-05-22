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
    <h1 class="page-header">取得 API 使用次數資訊</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->index->rate();</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->index->rate()); ?></pre>
</div>
</body>
</html>