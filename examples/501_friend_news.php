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
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/friendNews" target="blank">Options說明</a></div>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->friend->news()); ?></pre>
</div>
</body>
</html>
