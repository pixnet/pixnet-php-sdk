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
    <h1 class="page-header">查詢其他部落格公開資訊</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->info('userName');</pre>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">
        <label class="sr-only" for="query">使用者帳號</label>
        <input type="text" class="form-control" id="query" name="query" placeholder="請輸入使用者帳號">
      </div>
      <button type="submit" class="btn btn-primary">查詢</button>
    </form>
    <?php
        $query = $_POST['query'];
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->info('<?= $query; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->info($query)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
