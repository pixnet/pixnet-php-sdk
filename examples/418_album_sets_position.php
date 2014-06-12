<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
if (!empty($_POST['series']) and isset($_POST['set_folder_id'])) {
    $i = 0;
    foreach ($_POST['set_id'] as $id) {
        $series = $_POST['series'][$i++];
        $order[$series] = $id;
    }
    ksort($order);
    $order = implode('-', $order);
    $pixapi->album->sets->position($_POST['set_folder_id'], $order);
}
$pixapi->setDebugMode(1);
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
        <label class="col-sm-2 control-label" for="query">選擇相簿資料夾</label>
        <div class="col-sm-5">
            <select name="set_folder_id" class="form-control">
                <option value="0">根目錄</option>
            </select>
        </div>
      </div>
<?php foreach ($pixapi->album->sets->search($pixapi->getUserName(), ['parent_id' => 0]) as $set) {?>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query"><?= $set['title']?> : <?= $set['id']?></label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="series[]" placeholder="請輸入新順序" value="">
            <input type="hidden" name="set_id[]" value="<?= $set['id']?>">
        </div>
        <pre><?php var_dump($set)?></pre>
      </div>
<?php } ?>
      <button type="submit" class="btn btn-primary">修改相簿順序</button>
    </form>
    <pre><?php var_dump($_POST) ?></pre>
    <?php if (!empty($_POST['series']) and isset($_POST['set_folder_id'])) {
    ?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->sets->position(<?= htmlspecialchars($_POST['set_folder_id'])?>, <?= htmlspecialchars($order)?>, $options)
    </pre>
    <h3>執行結果</h3>
    <pre><?php var_dump($order) ?></pre>
    <?php }?>
</div>
</body>
</html>
