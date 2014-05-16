<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');

$query = $_GET['query'];
$query2 = $_POST['query2'];
if ('' != $query2) {
    $response = $pixapi->friend->friendships->removeGroup($query, $query2);
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
    <h1 class="page-header">將好友從群組移除</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->friendships->removeGroup($id, $name);</pre>
    <div class="panel panel-primary">
      <div class="panel-heading">實際測試</div>
      <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">選擇群組</label>
            <div class="col-sm-4"><select class="form-control" id="query" name="query" onchange="location.href=this.options[this.selectedIndex].value">
              <option value="">請選擇</option>
              <?php
              $groups = $pixapi->friend->groups->search();
              foreach ($groups['friend_groups'] as $group) {
                if ($group['id'] > 0) {
              ?>
                  <option value="<?= '?query=' . $group['id'] ?>" <?= ($query == $group['id']) ? 'selected' : '' ?>><?= $group['name'] ?></option>
              <?php
                }
              }
              ?>
              </select>
              </div>
          </div>
          <?php
          if ('' != $query) {
          ?>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">選擇好友</label>
            <div class="col-sm-4"><select class="form-control" id="query2" name="query2">
              <option value="">請選擇</option>
              <?php
              $friendships = $pixapi->friend->friendships->search();
              foreach ($friendships['friend_pairs'] as $friend) {
                if ($friend['id'] > 0) {
                    foreach ($friend['groups'] as $gro) {
                        if ($query == $gro['id']) {
              ?>
                  <option value="<?= $friend['user_name'] ?>" <?= ($query2 == $friend['user_name']) ? 'selected' : '' ?>><?= $friend['user_name'] ?></option>
              <?php
                        }
                    }
                }
              }
              ?>
              </select>
            </div>
          </div>
          <?php } ?>
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-danger">移除</button>
            </div>
          </div>
        </form>
        <?php if ('' != $query2) { ?>
        <h3>執行</h3>
        <pre>$pixapi->friend->friendships->removeGroup('<?= htmlspecialchars($query) ?>','<?= htmlspecialchars($query2) ?>');</pre>
        <h3>執行結果</h3>
        <pre><?php print_r($response); ?></pre>
        <?php } ?>
      </div>
    </div>
</div>
</body>
</html>
