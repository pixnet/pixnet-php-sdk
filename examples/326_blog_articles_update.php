<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
$id = $_GET['id'];
if ('' != $id) {
    $data = $pixapi->blog->articles->search($id)['data'];
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
    <h1 class="page-header">修改文章</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->articles->update($article_id, $title, $body, $options);</pre>
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/blogArticlesUpdate" target="blank">Options說明</a></div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">準備修改的文章</label>
            <div class="col-sm-4">
              <select class="form-control" id="id" name="id" onchange="location.href=this.options[this.selectedIndex].value">
              <option value="">請選擇</option>
              <?php
              $articles = $pixapi->blog->articles->latest(array('limit' => 5))['data'];
              foreach ($articles as $article) {
                if ($article['id'] > 0) {
              ?>
                  <option value="?id=<?= $article['id'] ?>" <?= ($id == $article['id']) ? 'selected' : ''; ?>><?= $article['title'] ?></option>
              <?php
                }
              }
              ?>
              </select>
              (只顯示最新5筆)
              </div>
          </div>
          <?php
          if ('' != $id) {
          ?>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">主旨(必填)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="query" name="query" placeholder="請輸入主旨" value="<?= $data['title']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">內文(必填)</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="query2" name="query2"><?= $data['body']; ?>&nbsp;</textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">建立</button>
            </div>
          </div>
          <?php
          }
          ?>
    </form>
    <?php
        $query = $_POST['query'];
        $query2 = $_POST['query2'];
        if ('' != $query and '' != $query2) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->articles->update('<?= $id; ?>', '<?= $query; ?>', '<?= $query2; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->articles->update($id, $query, $query2)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
