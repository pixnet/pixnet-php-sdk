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
    <h1 class="page-header">取得部落格個人所有文章</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->articles->search($options);</pre>
    <div class="well">
        <p>選填參數</p>
        <ul>
            <li><p>blog_password</p><p>如果指定使用者的 Blog 被密碼保護，則需要指定這個參數以通過授權</p></li>
            <li><p>page</p><p>頁數, 預設為1</p></li>
            <li><p>per_page</p><p>每頁幾筆, 預設為100</p></li>
            <li><p>category_id</p><p>個人分類參數, 預設是 null (所有分類文章)</p><p>多個分類 id 以逗號 (,) 分隔，例如 category_id=1234,5678,90。上限 10 個分類。</p></li>
            <li><p>status</p><p>文章狀態, 1: 草稿, 2: 公開, 3: 密碼, 4: 隱藏, 5: 好友, 7: 共同作者, 如果有指定則回傳指定狀態的文章, 預設是 null(所有文章)</p></li>
            <li><p>is_top</p><p>置頂, 1: 是, 0: 否, 如果有指定則回傳其指定文章, 預設是 null(所有文章)</p></li>
            <li><p>trim_user</p><p>是否每篇文章都要回傳作者資訊, 如果設定為 1, 則就不回傳. 預設是 0</p></li>
        </ul>
    </div>
    <h3>執行</h3>
    <pre>$pixapi->blog->articles->search();</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->articles->search()); ?></pre>
</div>
</body>
</html>
