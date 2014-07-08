<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$name = $pixapi->getUserName();
$sets = $pixapi->album->sets->search($name);
if (!isset($_GET['set_id'])) {
    $current_set = $sets[0];
} else {
    $current_set = $pixapi->album->sets->search($name, ['set_id' => $_GET['set_id']]);
}

$comments = $pixapi->album->sets->comments($name, $current_set['id']);
foreach ($comments as $c) {
    if ($c['is_spam']) {
        $c['body'] = "(spamed)" . $c['body'];
    }
    $modify_comments[] = $c;
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
    <h1 class="page-header">將留言設為廣告留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->comments->markHam($comment_id)</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li>
                <p>comment_id</p>
                <p>該留言 id</p>
            </li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">請選擇相簿</label>
        <div class="col-sm-5">
            <select class="form-control" id="query" name="set_id" onchange="updateComment(this.options[this.selectedIndex].value)">
                <?php foreach ($sets as $set) { ?>
                    <?php if ($set['id'] == $current_set['id']) {?>
                <option value="<?= $set['id']?>" selected><?= $set['title']?></option>
                    <?php } else {?>
                <option value="<?= $set['id']?>"><?= $set['title']?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">請選擇留言</label>
        <div class="col-sm-5">
            <select class="form-control" id="query" name="comment_id">
                <?php foreach ($modify_comments as $c) { ?>
                <option value="<?= $c['id']?>"><?= $c['body']?></option>
                <?php } ?>
            </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">設為非廣告留言</button>
    </form>
    <script>
    var updateComment = function(set_id) {
        var uri = location.pathname;
        var search = location.search;
        var hash = location.hash;
        if (search.indexOf('set_id') > 0) {
            search = search.split('&')[0];
        }
        location = (uri + search + '&set_id=' + set_id + hash);
    }
    </script>
    <?php if (!empty($_POST['comment_id'])) {?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->comments->markHam('<?= $_POST['comment_id'] ?>')
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->comments->markHam($_POST['comment_id'])); ?></pre>
    <?php }?>
</div>
</body>
</html>
