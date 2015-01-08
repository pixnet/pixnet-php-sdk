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
    <h1 class="page-header">列出部落格熱門文章</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->articles->hot($options = array());</pre>
    <div class="well">
        <p>選填參數</p>
        <ul>
            <li><p>blog_password</p><p>如果指定使用者的 Blog 被密碼保護，則需要指定這個參數以通過授權</p></li>
            <li><p>limit</p><p>回傳筆數, 預設為 100</p></li>
            <li><p>trim_user</p><p>是否每篇文章都要回傳作者資訊, 如果設定為 1, 則就不回傳. 預設是 0</p></li>
        </ul>
    </div>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->articles->hot(array('limit' => 1))); ?></pre>
</div>
</body>
</html>
