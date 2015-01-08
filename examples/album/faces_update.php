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
    <h1 class="page-header">新增人臉標記</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->faces->update($face_id, $user, $element_id, $x, $y, $w, $h);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>face_id</p><p>標記 id</p></li>
            <li><p>user</p><p>要更新標記的使用者帳號。被標記者必須設定標記者為好友。</p></li>
            <li><p>element_id</p><p>相片或影像的 id 。</p></li>
            <li><p>x</p><p>標記起點距相片最左邊的距離，單位是 px 。所對應的座標基準是 normal 這張相片。當不指定 recommend_id  時，需指定此參數。</p></li>
            <li><p>y</p><p>標記起點距相片最上緣的距離，單位是 px 。所對應的座標基準是 normal 這張相片。當不指定 recommend_id  時，需指定此參數。</p></li>
            <li><p>w</p><p>標記的寬度，單位是 px 。所對應的座標基準是 normal 這張相片。當不指定 recommend_id 時，需指定此參數 。</p></li>
            <li><p>h</p><p>標記的高度，單位是 px 。所對應的座標基準是 normal 這張相片。當不指定 recommend_id 時，需指定此參數 。</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="faceid">FACE ID(必填)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="faceid" name="faceid" placeholder="請輸入使用者帳號">
        </div>
      </div>
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
        $faceid = $_POST['faceid'];
        $X = $_POST['X'];
        $Y = $_POST['Y'];
        $W = $_POST['W'];
        $H = $_POST['H'];
        if ('' != $query and '' != $query2) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->album->faces->update('<?= $faceid; ?>', '<?= $query; ?>', <?= $query2; ?>, <?= $X; ?>, <?= $Y; ?>, <?= $W; ?>, <?= $H; ?>));</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->faces->update($faceid, $query, $query2, $X, $Y, $W, $H)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
