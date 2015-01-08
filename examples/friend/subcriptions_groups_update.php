<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');

$query = $_GET['query'];

$query2 = $_POST['query2'];
if ($query2 != '') {
    $response = $pixapi->friend->subscriptionGroups->update($query, $query2);
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
    <h1 class="page-header">修改訂閱群組</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->friend->subscriptionGroups->update($id, $name);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>id</p><p>群組 id</p></li>
            <li><p>name</p><p>群組名稱</p></li>
        </ul>
    </div>
    <div class="panel panel-primary">
      <div class="panel-heading"><a href="#execute" name="execute">實際測試</a></div>
      <div class="panel-body">
       <?php
       $group = $pixapi->friend->subscriptionGroups->search($query);
       ?>
        <form action="#execute" class="form-horizontal" role="form" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">準備修改的群組</label>
            <div class="col-sm-4"><select class="form-control" id="query" name="query" onchange="location.href=this.options[this.selectedIndex].value">
              <option value="">請選擇</option>
              <?php
              $groups = $pixapi->friend->subscriptionGroups->search();
              foreach ($groups['subscription_groups'] as $gro) {
                if ($gro['id'] > 0) {
              ?>
                  <option value="?query=<?= $gro['id'] ?>" <?= ($query == $gro['id']) ? 'selected' : ''; ?>><?= $gro['name'] ?></option>
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
            <label class="col-sm-2 control-label" for="query2">群組名稱(必填)</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="query2" name="query2" value="<?= $group['subscription_group']['name']; ?>">
            </div>
          </div>
          <?php } ?>
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">修改</button>
            </div>
          </div>
        </form>
        <?php
            if ('' != $query2) {
        ?>
        <h3>執行</h3>
        <pre>$pixapi->friend->subscriptionGroups->update('<?= htmlspecialchars($query) ?>','<?= htmlspecialchars($query2) ?>');</pre>
        <h3>執行結果</h3>
        <pre><?php print_r($response); ?></pre>
        <?php
            }
        ?>
      </div>
    </div>
</div>
</body>
</html>
