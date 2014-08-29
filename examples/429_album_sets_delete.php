<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
if ('' != ($_POST['set_id'])) {
    $result = $pixapi->album->sets->delete($_POST['set_id']);
}
$sets = $pixapi->album->sets->search($pixapi->getUserName())['data'];
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/include/top.php'); ?>
    <h1 class="page-header">刪除相簿</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->sets->delete($set_id);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>set_id</p><p>欲刪除的相簿 id</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">欲刪除的相簿 id</label>
        <div class="col-sm-5">
        <select name="set_id" class="form-control">
        <?php if (!empty($sets)) { ?>
        <?php foreach ($sets as $set) { ?>
            <?php if ($set['id'] == $_POST['set_id']) { ?>
            <option selected value="<?= $set['id']?>"><?= $set['title']?></option>
            <?php } else { ?>
            <option value="<?= $set['id']?>"><?= $set['title']?></option>
            <?php } ?>
        <?php } ?>
        <?php } else { ?>
            <option disabled>無相簿可供測試</option>
        <?php } ?>
        </select>
        </div>
        <p class="warning">警告：這將會直接從資料庫中刪除，請謹慎操作</p>
      </div>
      <button type="submit" class="btn btn-primary">刪除相簿</button>
    </form>
    <?php if ('' != ($_POST['set_id'])) {?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->sets->delete(<?= htmlspecialchars($_POST['set_id'])?>, $options)
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($result); ?></pre>
    <?php }?>
</div>
</body>
</html>
