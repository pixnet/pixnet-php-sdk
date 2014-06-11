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
    <h1 class="page-header">讀取單一留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->guestbook->search($id);</pre>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">

          <select class="form-control" id="query" name="query">
          <?php
          $guestbooks = $pixapi->guestbook->search();
          foreach ($guestbooks['articles'] as $guestbook) {
            if ($guestbook['id'] > 0) {
          ?>
              <option value="<?= $guestbook['id'] ?>" <?= ($query == $guestbook['id']) ? 'selected' : ''; ?>><?= $guestbook['title'] ?></option>
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
    <pre>$pixapi->guestbook->search(<?= $query; ?>);</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->guestbook->search($query)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
