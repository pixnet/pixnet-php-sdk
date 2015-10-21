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
    <h1 class="page-header">取得通知內容</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->user->notifications->search(array('skip_set_read' => 1)));</pre>
    <div class="well">
        <p>選填參數</p>
        <ul>
            <li><p>type</p><p>限制傳回通知類型 （friend: 好友互動，system: 系統通知，comments: 留言，appmarket:應用市集），預設為列出全部</p></li>
            <li><p>limit</p><p>傳回通知數量限制，預設為10筆</p></li>
            <li><p>skip_set_read</p><p>1: 不要把通知設定為已讀</p></li>
        </ul>
    </div>
    <h3>執行結果</h3>
    <pre><?php var_dump($pixapi->user->notifications->search(array('skip_set_read' => 1))); ?></pre>
</div>
</body>
</html>
