<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$name = $pixapi->getUserName();
$sets = $pixapi->album->sets->search($name)['data'];
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/include/top.php'); ?>
    <h1 class="page-header">取得單一相簿內的所有照片</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->sets->elements($name, $set_id, $options = array());</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>name</p><p>使用者名稱</p></li>
            <li><p>set_id</p><p>相簿 id</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>type</p><p>指定要回傳的類別. pic: 只顯示圖片; video: 只顯示影片; audio: 只顯示音樂</p></li>
            <li><p>page</p><p>頁數, 預設為1</p></li>
            <li><p>per_page</p><p>每頁幾筆, 預設為100</p></li>
            <li><p>password</p><p>相簿密碼，當使用者相簿設定為密碼相簿時使用</p></li>
            <li><p>with_detail</p><p>傳回詳細資訊，指定為1時將會回傳完整圖片資訊，預設為0</p></li>
            <li><p>trim_user</p><p>不傳回相片擁有者資訊，指定為1時將不會回傳相片擁有者資訊，預設為0</p></li>
            <li><p>use_iframe</p><p>影音的外嵌 tag 使用 iframe 格式</p></li>
            <li><p>iframe_width</p><p>影音的外嵌 iframe width</p></li>
            <li><p>iframe_height</p><p>影音的外嵌 iframe height</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">
        <label class="sr-only" for="query">使用者名稱(必填)</label>
        <input type="text" class="form-control" id="query" name="name" placeholder="請輸入使用者名稱" value="<?= $name ?>">
        <select name="set_id" class="form-control">
        <?php foreach ($sets as $set) { ?>
            <?php if ($set['id'] == $_POST['set_id']) { ?>
            <option selected value="<?= $set['id']?>"><?= $set['title']?></option>
            <?php } else { ?>
            <option value="<?= $set['id']?>"><?= $set['title']?></option>
            <?php } ?>
        <?php } ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">取得相簿內所有相片</button>
    </form>
    <?php if (!empty($_POST['set_id'])) {?>
    <h3>實際執行</h3>
    <pre>$pixapi->album->sets->elements(<?= htmlspecialchars($name)?>, <?= $_POST['set_id'] ?>, $options)</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->sets->elements($name, $_POST['set_id'])); ?></pre>
    <?php }?>
</div>
</body>
</html>
