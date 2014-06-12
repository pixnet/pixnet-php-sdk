<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$sets = $pixapi->album->sets->search($pixapi->getUserName());
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/include/top.php'); ?>
    <h1 class="page-header">取得個人單一相簿</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->sets->search($name, $options = array('set_id' => $set_id));</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
        <li>
        <p>name</p>
        <p>使用者名稱</p>
        </li>
        </ul>
        <p>選填參數</p>
        <ul>
        <li>
        <p>set_id</p>
        <p>相簿 id</p>
        </li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">
        <label class="sr-only" for="query">使用者名稱(必填)</label>
        <input type="text" class="form-control" id="query" name="name" placeholder="請輸入使用者名稱" value="<?= $_POST['name']?$_POST['name']:$pixapi->getUserName()?>">
        <select name="set_id" class="form-control">
        <?php foreach ($sets as $set) { ?>
            <?php if ($set['id'] == $_POST['set_id']) { ?>
            <option selected value="<?= $set['id']?>"><?= $set['title']?></option>
            <?php } else { ?>
            <option value="<?= $set['id']?>"><?= $set['title']?></option>
            <?php } ?>
        <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">取得個人單一相簿</button>
    </form>
    <?php if (!empty($_POST['name']) and !empty($_POST['set_id'])) {?>
    <h3>實際執行</h3>
    <pre>$pixapi->album->sets->search(<?= htmlspecialchars($_POST['name'])?>, array('set_id' => <?= htmlspecialchars($_POST['set_id']) ?>)</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->sets->search($_POST['name'], array('set_id' => $_POST['set_id']))); ?></pre>
    <?php }?>
</div>
</body>
</html>
