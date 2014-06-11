<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$query = $_POST['query'];
if ('' != $query) {
    $response = $pixapi->block->delete($query);
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
    <h1 class="page-header">刪除黑名單</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->block->delete($user);</pre>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">
          <select class="form-control" id="query" name="query">
          <?php
          $blocks = $pixapi->block->search();
          foreach ($blocks as $block) {
          ?>
              <option value="<?= $block['user']['name']; ?>" <?= ($query == $block['user']['name']) ? 'selected' : ''; ?>><?= $block['user']['display_name'] ?></option>
          <?php
          }
          ?>
          </select>
      </div>
      <button type="submit" class="btn btn-danger">刪除</button>
    </form>
    <?php
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->block->delete(<?= $query; ?>);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($response); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
