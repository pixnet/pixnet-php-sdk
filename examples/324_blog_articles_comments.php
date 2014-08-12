<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/include/top.php'); ?>
    <h1 class="page-header">取得指定文章之留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->articles->comments($id, $options = array());</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>id</p><p>指定要回傳的留言文章 id</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>blog_password</p><p>如果指定使用者的 Blog 被密碼保護，則需要指定這個參數以通過授權</p></li>
            <li><p>article_password</p><p>如果指定使用者的文章被密碼保護，則需要指定這個參數以通過授權</p></li>
            <li><p>filter</p><p>顯示特別屬性的留言. whisper: 只顯示悄悄話留言; nospam: 只顯示非廣告留言; noreply: 只顯示未回覆留言</p></li>
            <li><p>sort</p><p>排序條件. date-posted-asc: 依照留言時間由舊到新排序; date-posted-desc: 依照留言時間由新到舊排序</p></li>
            <li><p>page</p><p>頁數, 預設為1</p></li>
            <li><p>per_page</p><p>每頁幾筆, 預設為100</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">

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
      <button type="submit" class="btn btn-primary">查詢</button>
    </form>
    <?php
        $query = $_POST['query'];
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->articles->comments(<?= $query; ?>);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->articles->comments($query)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
