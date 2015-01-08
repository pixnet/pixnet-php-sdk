<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$name = $pixapi->getUserName();
$sets = $pixapi->album->sets->search($name)['data'];
if (count($sets) == 0) {
    $sets[] = ['id' => '" disabled="disabled', 'title' => '無相簿可供測試'];
}
if (isset($_FILES['file']) and !$_FILES['file']['error']) {
    $file = $_FILES['file'];
    $tmp_name = $file['tmp_name'];
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
    <h1 class="page-header">新增相片</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->elements->create($set_id, $tmp_file_name, $options = []);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>set_id</p><p>相簿 id，數字</p></li>
            <li><p>tmp_file_name</p><p>檔案名稱（包含路徑），文字</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">相簿</label>
        <div class="col-sm-5">
            <select class="form-control" name="set_id">
            <?php foreach ($sets as $set) { ?>
                <option value="<?= $set['id']?>"><?= $set['title']?></option>
            <?php } ?>
            </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">上傳相片</label>
          <div class="col-sm-5">
            <input class="form-control" type="file" name="file">
          </div>
      </div>
      <button type="submit" class="btn btn-primary">新增相片</button>
    </form>
    <?php if (!empty($_POST['set_id']) and !$file['error']) {?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->elements->create(<?= htmlspecialchars($_POST['set_id'])?>, '<?= $tmp_name ?>')
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->elements->create($_POST['set_id'], $tmp_name)); ?></pre>
    <?php }?>
</div>
</body>
</html>
