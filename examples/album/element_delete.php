<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$name = $pixapi->getUserName();
if (!empty($_POST['element_id'])) {
    $result = $pixapi->album->elements->delete($_POST['element_id']);
}
if (isset($_GET['set_id'])) {
    $elements = $pixapi->album->elements->search($name, ['set_id' => $_GET['set_id']])['data'];
}
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
    <h1 class="page-header">刪除單一相片（影音）</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->elements->update($element_id, $options);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>element_id</p><p>相片（影音） id，數字</p></li>
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
                <option value="<?= $set['id'] ?>" selected><?= $set['title'] ?></option>
                <?php } else { ?>
                <option value="<?= $set['id'] ?>"><?= $set['title'] ?></option>
                <?php } ?>
            <?php } ?>
            </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">相片</label>
        <div class="col-sm-5">
            <select class="form-control" name="element_id">
            <?php if (isset($elements)) { ?>
                <?php foreach ($elements as $element) { ?>
                <option value="<?= $element['id'] ?>"><?= $element['title'] ?></option>
                <?php } ?>
            <?php } else { ?>
                <option disabled>無相片可供測試</option>
            <?php } ?>
            </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">刪除相片（影音）資訊</button>
    </form>
    <?php if (isset($result)) { ?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->elements->delete(<?= $current_element['id'] ?>)
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($result); ?></pre>
    <?php } ?>
</div>
</body>
</html>
