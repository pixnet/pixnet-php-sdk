<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$name = $pixapi->getUserName();
if (isset($_GET['set_id'])) {
    $elements = $pixapi->album->elements->search($name, ['set_id' => $_GET['set_id']])['data'];
    $current_element = $elements[0];
}
if (!empty($_POST['title'])) {
    $result = $pixapi->album->elements->update($current_element['id'], ['title' => $_POST['title']]);
    $current_element['title'] = $_POST['title'];
}
$sets = $pixapi->album->sets->search($name)['data'];
if (count($sets) == 0) {
    $sets[] = ['id' => '" disabled="disabled', 'title' => '無相簿可供測試'];
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
    <h1 class="page-header">修改單一相片（影音）</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->elements->update($element_id, $options);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>element_id</p><p>相片（影音） id，數字</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>title</p><p>標題，文字</p></li>
            <li><p>description</p><p>描述，文字</p></li>
            <li><p>set_id</p><p>相簿 id，數字</p></li>
            <li><p>video_thumb_type</p><p>縮圖位置，文字，'begging': 開頭，'middle': 中間，'end': 結尾</p></li>
            <li><p>tags</p><p>標籤，以<code>,</code>為分隔，如<code>"foo,bar"</code></p></li>
            <li><p>latitude</p><p>經度，數字，例如: 23.973875</p></li>
            <li><p>longitude</p><p>緯度，數字，例如: 120.982024</p></li>
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
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">相片</label>
        <div class="col-sm-5">
            <select class="form-control" name="element_id">
            <?php if (isset($elements)) { ?>
                <?php foreach ($elements as $element) { ?>
                <option value="<?= $element['id']?>"><?= $element['title']?></option>
                <?php } ?>
            <?php } else { ?>
                <option disabled>請選擇相簿</option>
            <?php } ?>
            </select>
        </div>
      </div>
      <?php if (isset($current_element)) { ?>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">修改標題</label>
        <div class="col-sm-5">
            <input class="form-control" name="title" value="<?= $current_element['title']?>">
        </div>
      </div>
      <?php }?>
      <button type="submit" class="btn btn-primary">修改相片（影音）資訊</button>
    </form>
    <?php if (isset($result)) {?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->elements->update('<?= $current_element['id']?>', ['title' => '<?= htmlspecialchars($_POST['title'])?>'])
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($result); ?></pre>
    <?php }?>
</div>
</body>
</html>
