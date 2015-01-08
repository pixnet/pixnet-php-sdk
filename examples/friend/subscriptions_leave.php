<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');

$user = $pixapi->user->info();
$num = 0;
$type = 'checkbox';
if (1 != $user['is_vip']) {
    $type = 'radio';
}
$query2 = '';
$query = $_GET['query'];
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

if ($query and $query2) {
    $response = $pixapi->friend->subscriptions->leaveSubscriptionGroup($query, ['group_ids' => $query2]);
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
    <h1 class="page-header">離開訂閱群組</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->subscriptions->leaveSubscriptionGroup($name, $options = array());</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>user</p><p>要離開的訂閱使用者帳號</p></li>
            <li><p>group_ids</p><p>要離開的訂閱群組 id, 可以複數用 <code>,</code> 或 <code>-</code> 隔開</p></li>
        </ul>
    </div>
    <div class="panel panel-primary">
      <div class="panel-heading"><a href="#execute" name="execute">實際測試</a></div>
      <div class="panel-body">
        <form action="#execute" class="form-horizontal" role="form" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">訂閱帳號(必選)</label>
            <div class="col-sm-4">
            <select class="form-control" id="query" name="query" onchange="location.href=this.options[this.selectedIndex].value">
              <option value="">請選擇</option>
<?php
$subscriptions = $pixapi->friend->subscriptions->search();
foreach ($subscriptions['data'] as $subscription) {
    if ($subscription['user']['name'] and $subscription['groups']) {
?>
              <option value="?query=<?= $subscription['user']['name'] ?>" <?= ($query == $subscription['user']['name']) ? 'selected' : ''; ?>><?= $subscription['user']['name'] ?></option>
<?php
    }
}
?>
            </select>
            </div>
          </div>
<?php if ('' != $query) { ?>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">離開群組(必選)</label>
            <div class="col-sm-4">
<?php
        foreach ($subscriptions['data'] as $subscription) {
            if ($subscription['user']['name'] != $query or !$subscription['groups']) {
                continue;
            }
            foreach ($subscription['groups'] as $group) {
?>
              <input type="<?= $type ?>" id="query_<?= $group['id'] ?>" name="query_<?= $group['id'] ?>" value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
<?php
            }
        }
?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-danger">離開</button>
            </div>
          </div>
        </form>
        <?php if ($query and $query2) { ?>
        <h3>執行</h3>
        <pre>$pixapi->friend->subscriptions->joinSubscriptionGroup('<?= htmlspecialchars($query) ?>', array('group_ids' => '<?= htmlspecialchars($query2) ?>');</pre>
        <h3>執行結果</h3>
        <pre><?php print_r($response); ?></pre>
        <?php }
          }
        ?>
      </div>
    </div>
</div>
</body>
</html>
