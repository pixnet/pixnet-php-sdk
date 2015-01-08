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
    <h1 class="page-header">列出留言版留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->guestbook->search($option = array());</pre>
    <div class="well">
        <p>選填參數</p>
        <ul>
            <li><p>filter</p><p>顯示特別屬性的留言.</p><ul><li>whisper: 只顯示悄悄話留言;</li><li>noreply: 只顯示未回覆留言</li></ul></li>
            <li><p>cursor</p><p>頁數，以此指定頁數，回傳內容會包含下一頁的頁數以供瀏覽</p></li>
            <li><p>per_page</p><p>每頁幾筆, 預設為100</p></li>
        </ul>
    </div>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->guestbook->search()); ?></pre>
</div>
</body>
</html>
