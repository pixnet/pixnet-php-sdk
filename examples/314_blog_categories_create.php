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
    <h1 class="page-header">新增部落格分類</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->categoriescreate($name, $is_folder = false, $options = array());</pre>
    <div class="well"><a href="http://developer.pixnet.pro/#!/doc/pixnetApi/blogArticlesCreate" target="blank">Options說明</a></div>
    <div class="panel panel-primary">
      <div class="panel-heading"><a href="#execute" name="execute">實際測試</a></div>
      <div class="panel-body">
        <form action="#execute" class="form-horizontal" role="form" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">分類名稱(必填)</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="query2" name="query2">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="description">描述</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="description" name="description">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">型態</label>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" id="argv1" name="argv1" value="" checked="checked">分類</label>
                <label class="radio-inline"><input type="radio" id="argv1" name="argv1" value="1">資料夾</label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">顯示於前台</label>
            <div class="col-sm-10">
                <label>
                  <input type="checkbox" id="argv2" name="argv2" value="1" checked="checked"> 是
                </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">全站分類</label>
            <div class="col-sm-10">
              <select class="form-control" id="argv3" name="argv3">
              <?php
              $site_categories = $pixapi->blog->site_categories();
              foreach ($site_categories as $site_categorie) {
              ?>
                  <option value="<?= $site_categorie['id'] ?>"><?= $site_categorie['name'] ?></option>
              <?php
              }
              ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">全站分類對應</label>
            <div class="col-sm-10">
                <label>
                  <input type="checkbox" id="argv4" name="argv4" value="1" checked="checked"> 是
                </label>
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
            $query2 = $_POST['query2'];
            $description = $_POST['description'];
            $argv1 = '' != $_POST['argv1'] ? true : false;
            $argv2 = '' != $_POST['argv2'] ? true : false;
            $argv3 = intval($_POST['argv3']);
            $argv4 = '' != $_POST['argv4'] ? true : false;

            if ('' != $query2) {
                $options = array('description' => $description, 'show_index' => $argv2, 'site_category_id' => $argv3, 'site_category_done' => $argv4);
        ?>
        <h3>執行</h3>
        <pre>$pixapi->blog->categories->create('<?= $query2; ?>', <?= var_export($argv1); ?>, array('description' => <?= $description; ?>, 'show_index' => <?= var_export($argv2) ?>, 'site_category_id' => <?= $argv3; ?>, 'site_category_done' => <?= var_export($argv4); ?>));</pre>
        <h3>執行結果</h3>
        <pre><?php print_r($pixapi->blog->categories->create($query2, $argv1, $options)); ?></pre>
        <?php
            }
        ?>
      </div>
    </div>
</div>
</body>
</html>