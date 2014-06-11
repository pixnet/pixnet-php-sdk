<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$query = $_POST['query'];
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/include/top.php'); ?>
    <h1 class="page-header">列出部落格留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->comments->search($options = array());</pre>
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/blogComments" target="blank">Options說明</a></div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">

          <select class="form-control" id="query" name="query">
          <option value="all" <?= ('all' == $query) ? 'selected' : ''; ?>>全部文章</option>
          <?php
          $articles = $pixapi->blog->articles->latest(array('limit' => 5));
          foreach ($articles as $article) {
            if ($article['id'] > 0) {
          ?>
              <option value="<?= $article['id'] ?>" <?= ($query == $article['id']) ? 'selected' : ''; ?>><?= $article['title'] ?></option>
          <?php
            }
          }
          ?>
          </select>
          (只顯示最新5筆)
      </div>
      <button type="submit" class="btn btn-primary">查詢</button>
    </form>
    <?php
        if ('all' == $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->comments->search();</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->comments->search()); ?></pre>
    <?php
        } elseif ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->comments->search(array('article_id' => <?= $query; ?>'));</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->comments->search(array('article_id' => $query))); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>