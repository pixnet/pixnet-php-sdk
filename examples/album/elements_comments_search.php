<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$name = $pixapi->getUserName();
$sets = $pixapi->album->sets->search($name)['data'];
if ($sets) {
    foreach ($sets as $k => $set) {
        $count = $pixapi->album->sets->elements($name, $set['id'])['total'];
        $sets[$k]['title'] .= " ( $count )";
    }
    if (!isset($_GET['set_id'])) {
        $current_set = $sets[0];
    } else {
        $current_set = $pixapi->album->sets->search($name, ['set_id' => $_GET['set_id']])['data'];
    }
    $elements = $pixapi->album->sets->elements($name, $current_set['id'])['data'];
    foreach ($elements as $k => $e) {
        $count = $pixapi->album->elements->comments->search($name, ['element_id' => $e['id']], $options = [])['total'];
        $elements[$k]['title'] .= " ( $count )";
    }

    if (!isset($_GET['element_id'])) {
        $current_element = $elements[0];
    } else {
        $current_element = $pixapi->album->elements->comments->search($name, ['element_id' => $_GET['element_id']])['element'];
    }

    $comments = $pixapi->album->elements->comments->search($name, ['element_id' => $current_element['id']])['data'];
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
    <h1 class="page-header">取得相片上單一留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->elements->comments->search($name, ['comment_id' => $comment_id], $options = [])</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>name</p><p>使用者名稱</p></li>
            <li><p>comment_id</p><p>留言 id</p></li>
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
        <label class="col-sm-2 control-label" for="query">請選擇相簿</label>
        <div class="col-sm-5">
            <select class="form-control" id="set" name="set_id" onchange="updateUrl(this, ['element_id'])">
            <?php if ($sets) { ?>
                <?php foreach ($sets as $set) { ?>
                    <?php if ($set['id'] == $current_set['id']) { ?>
                <option value="<?= $set['id'] ?>" selected><?= $set['title'] ?></option>
                    <?php } else { ?>
                <option value="<?= $set['id'] ?>"><?= $set['title'] ?></option>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <option disabled selected>無相簿可供測試</option>
            <?php } ?>
            </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">請選擇照片</label>
        <div class="col-sm-5">
            <select class="form-control" id="element" name="element_id" onchange="updateUrl(this)">
            <?php if ($elements) { ?>
                <?php foreach ($elements as $e) { ?>
                    <?php if ($e['id'] == $current_element['id']) { ?>
                <option value="<?= $e['id'] ?>" selected><?= $e['title'] ?></option>
                    <?php } else { ?>
                <option value="<?= $e['id'] ?>"><?= $e['title'] ?></option>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <option disabled selected>無照片</option>
            <?php } ?>
            </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">請選擇留言</label>
        <div class="col-sm-5">
            <select class="form-control" id="comment" name="comment_id">
            <?php if ($comments) { ?>
                <?php foreach ($comments as $c) { ?>
                    <?php if ($c['id'] == $_POST['comment_id']) { ?>
                <option value="<?= $c['id'] ?>" selected><?= $c['body'] ?></option>
                    <?php } else { ?>
                <option value="<?= $c['id'] ?>"><?= $c['body'] ?></option>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <option disabled selected>無留言</option>
            <?php } ?>
            </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">取得照片留言</button>
    </form>
    <?php if (!empty($_POST['comment_id'])) { ?>
    <h3>實際執行</h3>
    <pre>$pixapi->album->elements->comments->search(<?= $name ?>, ['comment_id' => <?= $_POST['comment_id'] ?>], $options)</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->elements->comments->search($name, ['comment_id' => $_POST['comment_id']])); ?></pre>
    <?php } ?>
</div>
</body>
</html>
