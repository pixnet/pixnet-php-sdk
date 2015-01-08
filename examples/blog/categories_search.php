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
    <h1 class="page-header">取得部落格所有（單一）分類</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->categories->search($username, $options);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>username</p><p>文字，使用者名稱</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>blog_password</p><p>文字，部落格密碼</p></li>
            <li><p>category_id</p><p>數字，分類 id</p></li>
        </ul>
    </div>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->categories->search('emmatest')); ?></pre>
</div>
</body>
</html>
