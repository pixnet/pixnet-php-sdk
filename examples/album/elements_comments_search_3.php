<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$name = $pixapi->getUserName();
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/../include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/../include/top.php'); ?>
    <h1 class="page-header">取得相簿上所有留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->elements->comments->search($name, [], $options = [])</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>name</p><p>使用者名稱</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>page</p><p>頁數, 預設為1</p></li>
            <li><p>per_page</p><p>每頁幾筆, 預設為100</p></li>
            <li><p>password</p><p>相簿密碼，當使用者相簿設定為密碼相簿時使用</p></li>
        </ul>
    </div>
    <h3>實際執行</h3>
    <pre>$pixapi->album->elements->comments->search('<?= $name ?>', [], $options)</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->elements->comments->search($name, [])); ?></pre>
</div>
</body>
</html>
