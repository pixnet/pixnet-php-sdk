<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$query = $_POST['query'];
$comments = $pixapi->blog->comments->search();
if ($comments['total'] > 0) {
    foreach ($comments['data'] as $k => $v) {
        if ($v['is_open']) {
            $comments['data'][$k]['body'] .= "(公開)";
        } else {
            $comments['data'][$k]['body'] .= "(悄悄話)";
        }
    }
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
    <h1 class="page-header">將留言設為悄悄話</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->comments->close($id);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>id</p><p>留言的 id eg: 123456 or [123456,556678]</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">
          <select class="form-control" id="query" name="query">
          <?php
          if ($comments['total'] > 0) {
          foreach ($comments['data'] as $comment) {
          ?>
              <option value="<?= $comment['id'] ?>" <?= ($query == $comment['id']) ? 'selected' : ''; ?>><?= $comment['body'] ?></option>
          <?php
          }
          } else {
          ?>
              <option disabled>沒有留言</option>
          <?php } ?>
          </select>
      </div>
      <button type="submit" class="btn btn-primary">將留言設為悄悄話</button>
    </form>
    <?php
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->comments->close('<?= $query; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->comments->close($query)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
