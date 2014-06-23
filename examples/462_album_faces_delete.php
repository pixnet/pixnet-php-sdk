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
    <h1 class="page-header">刪除人臉標記</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->faces->delete($face_id);</pre>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">FACE ID(必填)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="query" name="query" placeholder="FACE ID">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-danger">刪除</button>
        </div>
      </div>
    </form>
    <?php
        $query = $_POST['query'];
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->album->faces->delete('<?= $query; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->faces->delete($query)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
