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
    <h1 class="page-header">修改相簿資料夾內的相簿順序</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->sets->position($title, $desc, $options = array());</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
        <li><p>parent_id</p>

        <p>欲排序的相簿資料夾(無資料夾則為 0)</p></li>
        <li><p>ids</p>

        <p>該資料夾內的相簿 id，順序以 <code>,</code> 或 <code>-</code> 為分隔，放在越前面的表示圖片的順序越優先。(EX: 12394813,12938503,12395064,12351423 or 12394813-12938503-12395064-12351423 )</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">欲排序的相簿資料夾 id</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="query" name="parent_id" placeholder="請輸入相簿資料夾 id" value="<?= $_POST['parent_id']? $_POST['parent_id'] : '0' ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">相簿的排序方式</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="query" name="ids" placeholder="請輸入相簿順序" value="<?= $_POST['ids']? $_POST['ids'] : '' ?>">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">修改相簿順序</button>
    </form>
    <?php if ('' != ($_POST['parent_id']) and !empty($_POST['ids'])) {?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->sets->position(<?= htmlspecialchars($_POST['parent_id'])?>, <?= htmlspecialchars($_POST['ids'])?>, $options)
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->sets->position($_POST['parent_id'], $_POST['ids'])); ?></pre>
    <?php }?>
</div>
</body>
</html>
