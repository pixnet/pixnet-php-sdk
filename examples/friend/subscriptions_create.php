<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');

$user = $pixapi->user->info();
$num = 0;
$type = 'checkbox';
$query2 = '';
$query = $_POST['query'];
$post = [];
$groups = $pixapi->friend->subscriptionGroups->search();

foreach ($groups['data'] as $group) {
    if (!$_POST['query_' . $group['id']]) {
        continue;
    }
    $post[] = $_POST['query_' . $group['id']];
}

foreach ($post as $result) {
    if ((count($post) - 1) > $num) {
        $query2 .= $result . ',';
    } else {
        $query2 .= $result;
    }
    $num++;
}

if ('' != $query) {
    if ('' == $query2) {
        $response = $pixapi->friend->subscriptions->create($query);
    } else {
        $response = $pixapi->friend->subscriptions->create($query, ['group_ids' => $query2]);
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
    <h1 class="page-header">新增訂閱</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->subscriptions->create($name, $options = array());</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>user</p><p>要加入的訂閱使用者帳號</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>group_ids</p><p>要加入的訂閱群組 id, 可以複數用 <code>,</code> 或 <code>-</code> 隔開</p></li>
        </ul>
    </div>
    <div class="panel panel-primary">
      <div class="panel-heading"><a href="#execute" name="execute">實際測試</a></div>
      <div class="alert alert-info">非VIP只能將使用者加入一個訂閱群組</div>
      <div class="panel-body">
        <form action="#execute" class="form-horizontal" role="form" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">訂閱帳號(必填)</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" id="query" name="query" placeholder="請輸入訂閱帳號">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">訂閱群組(可不選)</label>
            <div class="col-sm-4">
            <?php
              if (1 != $user['is_vip']) {
                  $type = 'radio';
              }
              foreach ($groups['data'] as $group) {
                if ($group['id'] > 0) {
              ?>
              <input type="<?= $type ?>" id="query_<?= $group['id'] ?>" name="query_<?= $group['id'] ?>" value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
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
        <?php if ('' != $query) { ?>
        <h3>執行</h3>
        <?php if ('' == $query2) { ?>
        <pre>$pixapi->friend->subscriptions->create('<?= htmlspecialchars($query) ?>');</pre>
        <?php } else { ?>
        <pre>$pixapi->friend->subscriptions->create('<?= htmlspecialchars($query) ?>', array('group_ids' => '<?= htmlspecialchars($query2) ?>');</pre>
        <?php } ?>
        <h3>執行結果</h3>
        <pre><?php print_r($response); ?></pre>
        <?php } ?>
      </div>
    </div>
</div>
</body>
</html>
