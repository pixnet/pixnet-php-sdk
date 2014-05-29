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
    <pre>$pixapi->album->sets($user_name, <a href="http://developer.pixnet.pro/#!/doc/pixnetApi/albumSets" target="blank">$options</a> = array());</pre>
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/albumSets" target="blank">Options說明</a></div>
    <h3>實際測試</h3>
    <form class="form-inline" role="form" method="POST">
      <div class="form-group">
        <label class="sr-only" for="query">使用者名稱(必填)</label>
        <input type="text" class="form-control" id="query" name="query" placeholder="請輸入使用者名稱">
      </div>
      <button type="submit" class="btn btn-primary">取得相簿列表</button>
    </form>
    <?php if (!empty($_POST['query'])) {?>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->sets->getUserSets($_POST['query'])); ?></pre>
    <?php }?>
</div>
</body>
</html>
