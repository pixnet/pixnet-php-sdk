<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/../include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/../include/top.php'); ?>
    <h1 class="page-header">新增文章留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->comments->create($user, $article_id, $body, $options);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>user</p><p>要留言的部落格作者名稱</p></li>
            <li><p>article_id</p><p>要留言的文章 id</p></li>
            <li><p>body</p><p>留言內容，文字</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>author</p><p>留言的暱稱, 不填入則預設代入認證使用者的 display_name</p></li>
            <li><p>title</p><p>留言標題</p></li>
            <li><p>url</p><p>個人網頁</p></li>
            <li><p>is_open</p><p>公開留言/悄悄話</p></li>
            <li><p>email</p><p>電子郵件</p></li>
            <li><p>blog_password</p><p>如果指定使用者的 Blog 被密碼保護，則需要指定這個參數以通過授權</p></li>
            <li><p>article_password</p><p>如果指定使用者的文章被密碼保護，則需要指定這個參數以通過授權</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">留言到(必填)</label>
        <div class="col-sm-10">
          <select class="form-control" id="query" name="query">
          <?php
          $articles = $pixapi->blog->articles->latest(array('limit' => 5))['data'];
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
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">內文(必填)</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="query2" name="query2" placeholder="請輸入內文"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">建立</button>
        </div>
      </div>
    </form>
    <?php
        $query = $_POST['query'];
        $query2 = $_POST['query2'];
        if ('' != $query and '' != $query2) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->comments->create('<?=$pixapi->getUserName(); ?>', '<?= $query; ?>', '<?= $query2; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->comments->create($pixapi->getUserName(), $query, $query2)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
