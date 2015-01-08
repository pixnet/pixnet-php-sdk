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
    <h1 class="page-header">取得相簿列表</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->sets->search($name, $options = array());</pre>
    <div class="well">
        <p>必傳變數</p>
        <ul>
            <li><p>name</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>parent_id</p><p>可以藉此指定拿到特定相簿資料夾底下的相簿</p></li>
            <li><p>trim_user</p><p>是否每篇文章都要回傳作者資訊, 如果設定為 1, 則就不回傳. 預設是 0</p></li>
            <li><p>page</p><p>頁數, 預設為1</p></li>
            <li><p>per_page</p><p>每頁幾筆, 預設為100</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">
        <label class="sr-only" for="query">使用者名稱(必填)</label>
        <input type="text" class="form-control" id="query" name="query" placeholder="請輸入使用者名稱" value="<?= $_POST['query'] ? $_POST['query'] : $pixapi->getUserName(); ?>">
      </div>
      <button type="submit" class="btn btn-primary">取得相簿列表</button>
    </form>
    <?php if (!empty($_POST['query'])) {?>
    <h3>實際執行</h3>
    <pre>$pixapi->album->sets->search(<?= htmlspecialchars($_POST['query']) ?>, $options)</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->sets->search($_POST['query'])); ?></pre>
    <?php }?>
</div>
</body>
</html>
