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
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/blogCategoriesPosition" target="blank">ids說明</a></div>
</div>
</body>
</html>