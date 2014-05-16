<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$query = $_POST['query'];
if ('' != $query) {
  $response = $pixapi->friend->friendships->delete($query);
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
    <h1 class="page-header">刪除好友</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->friendships->delete($name);</pre>
    <h3>實際測試</h3>
    <form class="form-inline" role="form" method="POST">
      <div class="form-group">

          <select class="form-control" id="query" name="query">
          <?php
          $friendships = $pixapi->friend->friendships->search();
          foreach ($friendships['friend_pairs'] as $friend) {
            if ($friend['id'] > 0) {
          ?>
              <option value="<?= $friend['user_name'] ?>" <?= ($query == $friend['user_name']) ? 'selected' : ''; ?>><?= $friend['user_name'] ?></option>
          <?php
            }
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
    <pre>$pixapi->friend->friendships->delete(<?= htmlspecialchars($query) ?>);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($response); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
