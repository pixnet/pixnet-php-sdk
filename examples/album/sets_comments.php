<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$name = $pixapi->getUserName();
$sets = $pixapi->album->sets->search($name)['data'];
if (count($sets) == 0) {
    $sets[] = ['id' => '" disabled="disabled', 'title' => '無相簿可供測試'];
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/../include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/../include/top.php'); ?>
    <h1 class="page-header">取得相簿留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->sets->comments($name, $set_id, $options = array());</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>name</p><p>使用者名稱</p></li>
            <li><p>set_id</p><p>相簿 id</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>page</p><p>頁數, 預設為1</p></li>
            <li><p>per_page</p><p>每頁幾筆, 預設為100</p></li>
            <li><p>password</p><p>相簿密碼，當使用者相簿設定為密碼相簿時使用</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-4 control-label" for="query">請選擇相簿</label>
        <div class="col-sm-5">
            <select class="form-control" id="query" name="set_id">
                <?php foreach ($sets as $set) { ?>
                <option value="<?= $set['id']?>"><?= $set['title']?></option>
                <?php } ?>
            </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">取得相簿內所有留言</button>
    </form>
    <?php if (!empty($_POST['set_id'])) {?>
    <h3>實際執行</h3>
    <pre>$pixapi->album->sets->comments('<?= htmlspecialchars($name)?>', <?= $_POST['set_id'] ?>, $options)</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->sets->comments($name, $_POST['set_id'])); ?></pre>
    <?php }?>
</div>
</body>
</html>
