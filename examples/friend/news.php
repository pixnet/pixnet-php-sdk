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
    <h1 class="page-header">好友動態</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->news($option = array());</pre>
    <div class="well">
        <p>選填參數</p>
        <ul>
            <li><p>group_type</p><p>subscription: 取出訂閱人的動態. friend: 取出好友的動態. 預設為 subscription</p></li>
            <li><p>group_id</p><p>指定訂閱的群組ID</p></li>
            <li><p>before_time</p><p>取出早於指定時間的動態</p></li>
        </ul>
    </div>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->friend->news()); ?></pre>
</div>
</body>
</html>
