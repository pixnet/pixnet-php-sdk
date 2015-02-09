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
    <h1 class="page-header">建立相簿資料夾</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->folders->create($title, $desc);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>title</p><p>標題，文字</p></li>
            <li><p>description</p><p>描述，文字</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">標題</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="query" name="title" placeholder="請輸入標題" value="<?= $_POST['title']? $_POST['title'] : 'PIXNET_SDK_FOLDER' ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">描述</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="query" name="desc" placeholder="請輸入描述" value="<?= $_POST['desc']? $_POST['desc'] : '這是 PIXNET_SDK 建立的相簿資料夾' ?>">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">建立相簿資料夾</button>
    </form>
    <?php if (!empty($_POST['title']) and !empty($_POST['desc'])) { ?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->folders->create(<?= htmlspecialchars($_POST['title']) ?>, <?= $_POST['desc'] ?>)
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->folders->create($_POST['title'], $_POST['desc'])); ?></pre>
    <?php } ?>
</div>
</body>
</html>
