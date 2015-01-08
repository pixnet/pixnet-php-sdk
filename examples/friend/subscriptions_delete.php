<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$name = '';
$query = $_POST['query'];
if ('' != $query) {
  $response = $pixapi->friend->subscriptions->delete($query);
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
    <h1 class="page-header">刪除訂閱</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->subscriptions->delete($name);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>name</p><p>要離開的訂閱使用者帳號</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">

          <select class="form-control" id="query" name="query">
          <?php
          $subscriptions = $pixapi->friend->subscriptions->search();
          foreach ($subscriptions['subscriptions'] as $subscription) {
              if ('' != $subscription['user']['name']) {
                  $name = $subscription['user']['name'];
?>
                  <option value="<?= $name ?>" <?= ($query == $name) ? 'selected' : ''; ?>><?= $name ?></option>
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
    <pre>$pixapi->friend->subscriptions->delete(<?= htmlspecialchars($query) ?>);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($response); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
