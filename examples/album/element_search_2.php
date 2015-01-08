<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$name = $pixapi->getUserName();
$sets = $pixapi->album->sets->search($name)['data'];
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
<?php require_once(__DIR__ . '/../include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/../include/top.php'); ?>
    <h1 class="page-header">搜尋單一相片（影音）</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->elements->search($name, $options = ['element_id' => $element_id]);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>name</p><p>使用者名稱，文字</p></li>
            <li><p>element_id</p><p>相片（影音） id，數字</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>password</p><p>相簿密碼，文字</p></li>
            <li><p>type</p><p>媒體類型，文字，指定要回傳的類別，pic 只顯示圖片，video 只顯示圖片，audio 只顯示音樂</p></li>
            <li><p>with_detail</p><p>詳細資訊，數字，傳回詳細資訊，指定為1時將會回傳完整圖片資訊，預設為0</p></li>
            <li><p>trim_user</p><p>相片擁有者資訊，數字，指定為1時將不會回傳相片擁有者資訊，預設為0</p></li>
            <li><p>use_iframe</p><p>影音的外嵌 tag 使用 iframe 格式</p></li>
            <li><p>iframe_width</p><p>iframe 寬度，數字</p></li>
            <li><p>iframe_height</p><p>iframe 高度，數字</p></li>
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
      <button type="submit" class="btn btn-primary">取得相片（影音）</button>
    </form>
    <?php if (!empty($_POST['set_id']) and !$file['error']) {?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->elements->search('<?= $pixapi->getUserName()?>', ['element_id' => <?= htmlspecialchars($_POST['element_id'])?>])
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->elements->search($pixapi->getUserName(), ['element_id' => $_POST['element_id']])); ?></pre>
    <?php }?>
</div>
</body>
</html>
