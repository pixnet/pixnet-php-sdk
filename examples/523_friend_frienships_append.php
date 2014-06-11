<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');

$query = $_POST['query'];
$query2 = $_POST['query2'];

if ('' != $query and '' != $query2 ) {
    $response = $pixapi->friend->friendships->appendGroup($query, $query2);
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
    <h1 class="page-header">將好友加入群組</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->friendships->appendGroup($name, $id);</pre>
    <div class="panel panel-primary">
      <div class="panel-heading"><a href="#execute" name="execute">實際測試</a></div>
      <div class="alert alert-info">非VIP只能將使用者加入一個群組</div>
      <div class="panel-body">
        <form action="#execute" class="form-horizontal" role="form" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">選擇好友(必選)</label>
            <div class="col-sm-4"><select class="form-control" id="query" name="query">
              <option value="">請選擇</option>
              <?php
              $friendships = $pixapi->friend->friendships->search();
              foreach ($friendships['friend_pairs'] as $friend) {
                if ($friend['id'] > 0 and !$friend['groups']) {
              ?>
                  <option value="<?= $friend['user_name'] ?>" <?= ($query == $friend['user_name']) ? 'selected' : '' ?>><?= $friend['user_name'] ?></option>
              <?php
                }
              }
              ?>
              </select>
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">群組名稱(必填)</label>
            <div class="col-sm-4"><select class="form-control" id="query2" name="query2">
              <option value="">請選擇</option>
              <?php
              $groups = $pixapi->friend->groups->search();
              foreach ($groups['friend_groups'] as $group) {
                if ($group['id'] > 0) {
              ?>
                  <option value="<?= $group['id'] ?>" <?= ($query2 == $group['id']) ? 'selected' : '' ?>><?= $group['name'] ?></option>
              <?php
                }
              }
              ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">加入</button>
            </div>
          </div>
        </form>
        <?php if ('' != $query and '' != $query2) { ?>
        <h3>執行</h3>
        <pre>$pixapi->friend->friendships->appendGroup('<?= htmlspecialchars($query) ?>','<?= htmlspecialchars($query2) ?>');</pre>
        <h3>執行結果</h3>
        <pre><?php print_r($response); ?></pre>
        <?php } ?>
      </div>
    </div>
</div>
</body>
</html>
