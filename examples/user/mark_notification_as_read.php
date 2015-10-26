<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
mb_internal_encoding("UTF-8");
if (isset($_POST['query']) and $id = $_POST['query']) {
    $result = $pixapi->user->notifications->markRead(intval($id));
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
    <h1 class="page-header">設定通知為已讀</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->user->notifications->markRead($id);</pre>
    <div class="well">
        <p>選填參數</p>
        <ul>
            <li><p>type</p><p>限制傳回通知類型 （friend: 好友互動，system: 系統通知，comments: 留言，appmarket:應用市集），預設為列出全部</p></li>
            <li><p>limit</p><p>傳回通知數量限制，預設為10筆</p></li>
            <li><p>skip_set_read</p><p>1: 不要把通知設定為已讀</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
        <div class="form-group">
            <select class="form-control" id="query" name="query">
            <?php 
            $notifies = $pixapi->user->notifications->search(array('skip_set_read' => 1));
            if (0 == count($notifies['data'])) {
            ?>
            <option disabled>尚無未讀通知</option>
            <?php } else { ?>
            <?php
            foreach ($notifies['data'] as $notify) {
                $title_wording = isset($notify['title'][5]) ? mb_substr(strip_tags($notify['title']), 0, 5) . '...' : $notify['title'];
                $body_wording = isset($notify['body'][5]) ? mb_substr(strip_tags($notify['body']), 0, 5) . '...' : $notify['body'];
            ?>
                <option value="<?= $notify['id'] ?>" <?= ($query == $notify['id']) ? 'selected' : ''; ?>><?= $title_wording ?> - <?= $body_wording ?></option>
            <?php } ?>
            <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">設為已讀</button>
    </form>
    <?php if (isset($result)) { ?>
    <h3>執行結果</h3>
    <pre><?php var_dump($result); ?></pre>
    <?php } ?>
</div>
</body>
</html>
