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
    <h1 class="page-header">將留言設為廣告</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->guestbook->markSpam($id);</pre>
    <h3>實際測試</h3>
    <form class="form-inline" role="form" method="POST">
      <div class="form-group">
          <select class="form-control" id="query" name="query">
          <?php
          $guestbooks = $pixapi->guestbook->search();
          foreach ($guestbooks['articles'] as $guestbook) {
          ?>
              <option value="<?= $guestbook['id'] ?>" <?= ($query == $guestbook['id']) ? 'selected' : ''; ?>><?= $guestbook['title'] ?></option>
          <?php
          }
          ?>
          </select>
      </div>
      <button type="submit" class="btn btn-primary">將留言設為廣告</button>
    </form>
    <?php
        $query = $_POST['query'];
        if ('' != $query) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->guestbook->markSpam('<?= $query; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->guestbook->markSpam($query)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>