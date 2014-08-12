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
    <h1 class="page-header">修改部落格分類排序</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->categories->position($ids);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>ids</p><p>分類 id 順序以 <code>,</code> 或 <code>-</code> 為分隔，放在越前面的表示圖片的順序越優先。不過在排序上分類資料夾的排序要優先於分類，所以對分類資料夾的排序指定只會影響資料夾群本身。(EX: 12394813,12938503,12395064,12351423 or 12394813-12938503-12395064-12351423 )</p></li>
        </ul>
    </div>
</div>
</body>
</html>
