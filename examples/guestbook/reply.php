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
    <h1 class="page-header">回覆留言版留言</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->guestbook->reply($id, $body);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>id</p><p>留言 id</p></li>
            <li><p>body</p><p>留言內容，文字</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">留言：</label>
        <div class="col-sm-10">
            <select class="form-control" id="query" name="query">
          <?php
          $guestbooks = $pixapi->guestbook->search();
          foreach ($guestbooks['data'] as $guestbook) {
          ?>
              <option value="<?= $guestbook['id'] ?>" <?= ($query == $guestbook['id']) ? 'selected' : ''; ?>><?= $guestbook['title'] ?></option>
          <?php
          }
          ?>
          </select>
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
    <pre>$pixapi->guestbook->reply('<?= $query; ?>', '<?= $query2; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->guestbook->reply($query, $query2)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
