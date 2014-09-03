<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$name = $pixapi->getUserName();
$sets = $pixapi->album->sets->search($name)['data'];
if (isset($_POST['series']) and isset($_POST['element_id'])) {
    $i = 0;
    foreach ($_POST['element_id'] as $id) {
        $series = $_POST['series'][$i++];
        $order[$series] = $id;
    }
    ksort($order);
    $order = implode('-', $order);
    $result = $pixapi->album->elements->position($_GET['set_id'], $order);
}
if (count($sets) == 0) {
    $sets[] = ['id' => '" disabled="disabled', 'title' => '無相簿可供測試'];
}
if (isset($_GET['set_id'])) {
    $elements = $pixapi->album->elements->search($name, ['set_id' => $_GET['set_id']])['data'];
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
    <h1 class="page-header">調整相片（影音）順序</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->elements->position($set_id, $ids);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>set_id</p><p>相簿 id，數字</p></li>
            <li><p>ids</p><p>相片（影音） id，字串，排序後的 id，以<code>,</code>或<code>-</code>分隔</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">相簿</label>
        <div class="col-sm-5">
            <select class="form-control" name="set_id" onchange="location.search='set_id=' + this.options[this.selectedIndex].value">
            <?php if (!isset($_GET['set_id'])) { ?>
                <option selected>請選擇</option>
            <?php } ?>
            <?php foreach ($sets as $set) { ?>
                <?php if ($set['id'] == $_GET['set_id']) { ?>
                <option value="<?= $set['id']?>" selected><?= $set['title']?></option>
                <?php } else { ?>
                <option value="<?= $set['id']?>"><?= $set['title']?></option>
                <?php } ?>
            <?php } ?>
            </select>
        </div>
    </div>
            <?php if (isset($elements)) { ?>
                <?php foreach ($elements as $element) { ?>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query"><?= $element['title']?></label>
        <div class="col-sm-5">
            <input name="element_id[]" type="hidden" value="<?= $element['id']?>">
            <input name="series[]" class="form-control" type="text" value="">
        </div>
      </div>
                <?php } ?>
            <?php } ?>
      <button type="submit" class="btn btn-primary">修改相片（影音）順序</button>
    </form>
    <?php if (isset($result)) {?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->elements->position(<?= $_GET['set_id']?>, '<?= $order?>')
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($result); ?></pre>
    <?php }?>
</div>
</body>
</html>
