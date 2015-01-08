<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$query = $_POST['query'];
if ('' != $query) {
  $response = $pixapi->friend->subscriptionGroups->delete($query);
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
    <h1 class="page-header">刪除訂閱群組</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->subscriptionGroups->delete($id);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>id</p><p>群組 id</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">

          <select class="form-control" id="query" name="query">
          <?php
          $groups = $pixapi->friend->subscriptionGroups->search();
          foreach ($groups['subscription_groups'] as $group) {
            if ($group['id'] > 0) {
          ?>
              <option value="<?= $group['id'] ?>" <?= ($query == $group['id']) ? 'selected' : ''; ?>><?= $group['name'] ?></option>
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
    <pre>$pixapi->friend->subscriptionGroups->delete(<?= $query ?>);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($response); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
