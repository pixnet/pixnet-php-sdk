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
  $response = $pixapi->blog->categories->delete($query, $isFolder);
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
    <h1 class="page-header">刪除部落格單一分類</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->categories->delete($id, $is_folder = false);</pre>
    <h3>實際測試</h3>
    <form class="form-inline" role="form" method="POST">
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
      <button type="submit" class="btn btn-danger">刪除</button>
    </form>
    <?php
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->categories->delete(<?= $query; ?>, <? var_export($isFolder); ?>);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($response); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>