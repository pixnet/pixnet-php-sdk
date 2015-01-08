<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$name = $pixapi->getUserName();
$folders = $pixapi->album->folders->search($name);
if (isset($_GET['folder_id'])) {
    $current = $pixapi->album->folders->search($name, ['folder_id' => $_GET['folder_id']]);
} else {
    $current = $pixapi->album->folders->search($name, ['folder_id' => $folders[0]['id']]);
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/include/top.php'); ?>
    <h1 class="page-header">修改相簿資料夾</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->folders->update($folder_id, $title, $desc);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>folder_id</p><p>相簿資料夾 id，數字</p></li>
            <li><p>title</p><p>標題，文字</p></li>
            <li><p>description</p><p>描述，文字</p></li>
        </ul>
    </div>
    <h3><a name="execute" href="#execute">實際測試</a></h3>
    <form class="form-horizontal" role="form" method="POST" action="#execute">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">相簿資料夾</label>
        <div class="col-sm-5">
        <select id="folder_id" name="folder_id" class="form-control" onchange="location.href=this.options[this.selectedIndex].value + '#execute'">
        <?php foreach ($folders as $folder) {?>
            <?php if ($folder['id'] == $_GET['folder_id']) { ?>
            <option selected value="?folder_id=<?= $folder['id']?>"><?= $folder['title']?></option>
            <?php } else { ?>
            <option value="?folder_id=<?= $folder['id']?>"><?= $folder['title']?></option>
            <?php } ?>
        <?php } ?>
        </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">標題</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="title" name="title" placeholder="請輸入標題" value="<?= $current['title']? $current['title'] : $folder['title'] ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">描述</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="desc" name="desc" placeholder="請輸入描述" value="<?= $current['description']? $current['description'] : $folder['description'] ?>">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">修改相簿資料夾</button>
    </form>
    <?php if (!empty($_POST['title']) and !empty($_POST['desc'])) {?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->folders->update(<?= htmlspecialchars($_POST['folder_id'])?>, '<?= htmlspecialchars($_POST['title'])?>', '<?= $_POST['desc'] ?>')
    </pre>
    <h3>執行結果</h3>
    <?php
        $folder_id = explode('=', $_POST['folder_id'])[1];
    ?>
    <pre><?php print_r($pixapi->album->folders->update($folder_id, $_POST['title'], $_POST['desc'])); ?></pre>
    <?php }?>
</div>
</body>
</html>
