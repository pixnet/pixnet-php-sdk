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
    <h1 class="page-header">將留言設為公開</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->guestbook->open($id);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>id</p><p>留言 id</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">
        <select class="form-control" id="query" name="query">
          <?php
          $guestbooks = $pixapi->guestbook->search(array('filter' => 'whisper'));
          if ($guestbooks['total']) {
              foreach ($guestbooks['data'] as $guestbook) {
          ?>
              <option value="<?= $guestbook['id'] ?>" <?= ($query == $guestbook['id']) ? 'selected' : ''; ?>><?= $guestbook['title'] ?></option>
          <?php
              }
          } else {
          ?>
              <option disabled>無留言可提供測試</option>
          <?php } ?>
          </select>
      </div>
      <button type="submit" class="btn btn-primary">設定為公開</button>
    </form>
    <?php
        $query = $_POST['query'];
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->guestbook->open('<?= $query; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->guestbook->open($query)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
