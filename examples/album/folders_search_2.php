<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$folders = $pixapi->album->folders->search($pixapi->getUserName());
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/../include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/../include/top.php'); ?>
    <h1 class="page-header">取得個人單一相簿資料夾</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->folders->search($name, $options = array('folder_id' => $folder_id));</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>name</p><p>使用者名稱</p></li>
            <li><p>folder_id</p><p>相簿資料夾 id</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">
        <label class="sr-only" for="query">使用者名稱(必填)</label>
        <input type="text" class="form-control" id="query" name="name" placeholder="請輸入使用者名稱" value="<?= $_POST['name']?$_POST['name']:$pixapi->getUserName()?>">
        <select name="folder_id" class="form-control">
        <?php foreach ($folders as $folder) { ?>
            <?php if ($folder['id'] == $_POST['folder_id']) { ?>
            <option selected value="<?= $folder['id']?>"><?= $folder['title']?></option>
            <?php } else { ?>
            <option value="<?= $folder['id']?>"><?= $folder['title']?></option>
            <?php } ?>
        <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">取得個人單一相簿</button>
    </form>
    <?php if (!empty($_POST['name']) and !empty($_POST['folder_id'])) {?>
    <h3>實際執行</h3>
    <pre>$pixapi->album->folders->search(<?= htmlspecialchars($_POST['name'])?>, array('folder_id' => <?= htmlspecialchars($_POST['folder_id']) ?>))</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->folders->search($_POST['name'], array('folder_id' => $_POST['folder_id']))); ?></pre>
    <?php }?>
</div>
</body>
</html>
