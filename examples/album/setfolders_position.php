<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$name = $pixapi->getUserName();
if (!empty($_POST['series'])) {
    $i = 0;
    foreach ($_POST['set_id'] as $id) {
        $series = $_POST['series'][$i++];
        $order[$series] = $id;
    }
    ksort($order);
    $order = implode('-', $order);
    $pixapi->album->setfolders->position($order);
}
$folders = $pixapi->album->setfolders->search($name)['data'];
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/../include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/../include/top.php'); ?>
    <h1 class="page-header">修改相簿首頁的相簿順序</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->setfolders->position($ids);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>ids</p><p>該資料夾內的相簿 id，按照順序以 <code>,</code> 或 <code>-</code> 為分隔，放在越前面的表示圖片的順序越優先。(EX: 12394813,12938503,12395064,12351423 or 12394813-12938503-12395064-12351423 )</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <?php if ($folders) { ?>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
    <?php foreach ($pixapi->album->setfolders->search($pixapi->getUserName())['data'] as $set) { ?>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query"><?= $set['title']?></label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="series[]" placeholder="請輸入新順序" value="">
            <input type="hidden" name="set_id[]" value="<?= $set['id']?>">
        </div>
      </div>
    <?php } ?>
      <button type="submit" class="btn btn-primary">修改相簿順序</button>
    </form>
    <?php } else { ?>
    <p class="text-left">抱歉，您尚未有相簿可供操作，請先到您的<a target="_blank" href="http://panel.pixnet.cc/album/albummanagement">管理後台</a>新增以順利使用</p>
    <?php } ?>
    <?php if (!empty($_POST['series']) and isset($_POST['set_folder_id'])) {
    ?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->setfolders->position(<?= htmlspecialchars($order)?>)
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->setfolders->position($order)) ?></pre>
    <?php }?>
</div>
</body>
</html>
