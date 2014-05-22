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
    <h1 class="page-header">新增文章</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->articles->create($title, $body, $options);</pre>
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/blogArticlesCreate" target="blank">Options說明</a></div>
    <h3>實際測試</h3>
    <form class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">主旨(必填)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="query" name="query" placeholder="請輸入主旨">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">內文(必填)</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="query2" name="query2" placeholder="請輸入內文"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">建立</button>
        </div>
      </div>
    </form>
    <?php
        $query = $_POST['query'];
        $query2 = $_POST['query2'];
        if ('' != $query and '' != $query2) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->articles->create('<?= $query; ?>', '<?= $query2; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->articles->create($query, $query2)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>