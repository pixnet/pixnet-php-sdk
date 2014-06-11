<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$num = 0;
$post = [];
$query = '';
$groups = $pixapi->friend->subscriptionGroups->search();
if ($_POST) {
    foreach ($groups['subscription_groups'] as $group) {
        $post[$group['id']] = intval($_POST['query_' . $group['id']]);
        if (!$_POST['query_' . $group['id']]) {
        }
    }

    asort($post);

    foreach ($post as $key => $result) {
        if ((count($post) - 1) > $num) {
            $query .= $key . ',';
        } else {
            $query .= $key;
        }
        $num++;
    }

    if ('' != $query) {
        $response = $pixapi->friend->subscriptionGroups->position($query);
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
    <h1 class="page-header">修改訂閱群組排序</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->subscriptionGroups->position($ids);</pre>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
<?php
        $num = 0;
          foreach ($groups['subscription_groups'] as $group) {
?>
      <div class="form-group">
          <?php
            if ($group['id'] > 0) {
          ?>
          <label class="col-sm-1 control-label" for="query_<?= $group['id'] ?>"><?= $group['name'] ?></label>
          <div class="col-sm-2">
          <input type="text" class="form-control" id="query_<?= $group['id'] ?>" name="query_<?= $group['id'] ?>" placeholder="請輸入順序">
          </div>
          <?php
            }
          ?>
      </div>
      <?php } ?>
      <button type="submit" class="btn btn-primary">修改</button>
    </form>
    <?php
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <div class="alert alert-info">群組 id 順序以 , 或 - 為分隔，放在越前面的表示圖片的順序越優先</div>
    <pre>$pixapi->friend->subscriptionGroups->position('<?= htmlspecialchars($query) ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($response) ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
