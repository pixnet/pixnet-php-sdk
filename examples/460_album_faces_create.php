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
    <h1 class="page-header">新增人臉標記</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->faces->create($user, $element_id, $x, $y, $w, $h);</pre>
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/albumFaces" target="blank">Options說明</a></div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">使用者帳號(必填)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="query" name="query" placeholder="請輸入使用者帳號">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">相片ID(必填)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="query2" name="query2" placeholder="請輸入相片ID">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">標記起點距相片最左邊的距離(必填)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="X" name="X" placeholder="X">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">標記起點距相片最上緣的距離(必填)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="Y" name="Y" placeholder="Y">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">寬度(必填)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="W" name="W" placeholder="W">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">高度(必填)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="H" name="H" placeholder="H">
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
        $X = $_POST['X'];
        $Y = $_POST['Y'];
        $W = $_POST['W'];
        $H = $_POST['H'];
        if ('' != $query and '' != $query2) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->album->faces->create('<?= $query; ?>', <?= $query2; ?>, <?= $X; ?>, <?= $Y; ?>, <?= $W; ?>, <?= $H; ?>));</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->faces->create($query, $query2, $X, $Y, $W, $H)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
