<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$query = $_POST['query'];
$comments = $pixapi->blog->comments->search();
if ($comments['total'] > 0) {
    foreach ($comments['data'] as $k => $v) {
        if ($v['is_spam']) {
            $comments['data'][$k]['body'] .= "(廣告留言)";
        } else {
            $comments['data'][$k]['body'] .= "(非廣告留言)";
        }
    }
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
    <h1 class="page-header">將留言設為非廣告留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->comments->markHam($id);</pre>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">
          <?php
          $comments = $pixapi->blog->comments->search();
          ?>
          <select class="form-control" id="query" name="query">
          <?php
          foreach ($comments as $comments) {
          ?>
              <option value="<?= $comments['id'] ?>" <?= ($query == $comments['id']) ? 'selected' : ''; ?>><?= $comments['body'] ?></option>
          <?php
          }
          ?>
          </select>
      </div>
      <button type="submit" class="btn btn-primary">將留言設為非廣告留言</button>
    </form>
    <?php
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->comments->markHam('<?= $query; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->comments->markHam($query)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
