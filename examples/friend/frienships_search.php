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
    <h1 class="page-header">列出好友名單</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->friendships->search($option = array());</pre>
    <div class="well">
        <p>選填參數</p>
        <ul>
        <li><p>cursor</p><p>頁數，每次回傳資料數量為 100 筆，以此指定頁數，回傳內容會包含下一頁的頁數以供瀏覽</p></li>
        <li><p>cursor_name</p><p>預設是 user_name，可以藉由指定為 id 來讓 friendship 依照 id 來排列</p></li>
        <li><p>bidirectional</p><p>設為1時，只顯示互為好友名單，預設為0</p></li>
        </ul>
    </div>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->friend->friendships->search()); ?></pre>
</div>
</body>
</html>
