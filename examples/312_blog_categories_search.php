<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$query = $_POST['query'];
if ('' != $query) {
  $querys = explode('##', $query);
  $query = $querys[0];
  $isFolder = false;
  if ('folder' == $querys[1]) {
      $isFolder = true;
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
    <h1 class="page-header">取得部落格單一分類</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->categories->search($id, $is_folder = false);</pre>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">

          <select class="form-control" id="query" name="query">
          <?php
          $categories = $pixapi->blog->categories->search();
          foreach ($categories as $categorie) {
            if ($categorie['id'] > 0) {
          ?>
              <option value="<?= $categorie['id'] ?>##<?= $categorie['type'] ?>" <?= ($query == $categorie['id']) ? 'selected' : ''; ?>><?= $categorie['name'] ?></option>
          <?php
            }
          }
          ?>
          </select>
      </div>
      <button type="submit" class="btn btn-primary">查詢</button>
    </form>
    <?php
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->categories->search(<?= $query; ?>, <? var_export($isFolder)?>);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->categories->search($query, $isFolder)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>