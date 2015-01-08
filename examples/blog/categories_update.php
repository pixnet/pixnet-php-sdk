<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');

$query = $_GET['query'];
$type = $_GET['type'];
$isFolder = false;
if ('folder' == $type) {
    $isFolder = true;
}

$query2 = $_POST['query2'];
if ($query2 != '') {
    $description = $_POST['description'];
    $argv2 = intval($_POST['argv2']);
    $argv3 = '' != $_POST['argv3'] ? true : false;
    $argv4 = '' != $_POST['argv4'] ? true : false;

    $options = array('description' => $description, 'show_index' => $argv2, 'site_category_id' => $argv3, 'site_category_done' => $argv4);
    $response = $pixapi->blog->categories->update($query, $query2, $isFolder, $options);
}

$row_data = $pixapi->blog->categories->search($pixapi->getUserName());
if ($row_data['total'] > 1) {
    $categories = $row_data['data'];
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
    <h1 class="page-header">修改部落格分類</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->categories->update($id, $name, $is_folder = false, $options = array());</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>id</p><p>分類id，數字</p></li>
            <li><p>name</p><p>分類名稱，文字</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>is_folder</p><p>若為分類資料夾為 true，否則為 false</p></li>
            <li><p>description</p><p>分類說明，文字</p></li>
            <li><p>show_index</p><p>是否在首頁上顯示, 1: yes, 0: no. 預設為 1</p></li>
            <li><p>site_category_id</p><p>對應的全站文章類別 id. 只有當 is_folder 為 false 時需要, 預設為 0</p></li>
            <li><p>site_category_done</p><p>是否已決定對應. 只有當 is_folder 為 false 時需要. 如果它設為 0, 則 PIXNET 後台會在發表文章時詢問是否要對應全站文章類別</p></li>
        <ul>
    </div>
    <div class="panel panel-primary">
      <div class="panel-heading"><a href="#execute" name="execute">實際測試</a></div>
      <div class="panel-body">
        <form action="#execute" class="form-horizontal" role="form" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">準備修改的分類</label>
            <div class="col-sm-4"><select class="form-control" id="query" name="query" onchange="location.href=this.options[this.selectedIndex].value">
              <?php if (isset($categories)) { ?>
              <option value="">請選擇</option>
              <?php
                  foreach ($categories as $categorie) {
                    if ($categorie['id'] > 0) {
              ?>
                  <option value="?query=<?= $categorie['id'] ?>&type=<?= $categorie['type'] ?>" <?= ($query == $categorie['id']) ? 'selected' : ''; ?>><?= $categorie['name'] ?></option>
              <?php
                    }
                  }
              } else {
              ?>
              <option disabled>無分類可供測試</option>
              <?php } ?>
              </select>
              </div>
          </div>
          <?php
          if ('' != $query) {
          ?>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">分類名稱(必填)</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="query2" name="query2" value="<?= $category['name']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="description">描述</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="description" name="description" value="<?= $category['description']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">顯示於前台</label>
            <div class="col-sm-10">
                <label>
                  <input type="checkbox" id="argv2" name="argv2" value="1" <?= (1 == $category['show_index']) ? ' checked="checked"' : ''; ?>> 是
                </label>
            </div>
          </div>
          <?php if (!$isFolder) { ?>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query2">全站分類</label>
            <div class="col-sm-10">
              <select class="form-control" id="argv3" name="argv3">
              <?php
              $site_categories = $pixapi->blog->siteCategories()['data'];
              foreach ($site_categories as $site_categorie) {
              ?>
                  <option value="<?= $site_categorie['id'] ?>" <?= ($site_categorie['id'] == $category['site_category_id']) ? ' selected="selected"' : ''; ?>><?= $site_categorie['name'] ?></option>
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
                  <input type="checkbox" id="argv4" name="argv4" value="1" <?= (1 == $category['site_category_done']) ? ' checked="checked"' : ''; ?>> 是
                </label>
            </div>
          </div>
          <?php } ?>
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">修改</button>
            </div>
          </div>
        </form>
        <?php
            if ('' != $query2) {
        ?>
        <h3>執行</h3>
        <pre>$pixapi->blog->categories->update('<?= $query; ?>','<?= $query2; ?>', array('description' => <?= $description; ?>, 'show_index' => <?= var_export($argv2) ?>, 'site_category_id' => <?= $argv3; ?>, 'site_category_done' => <?= var_export($argv4); ?>));</pre>
        <h3>執行結果</h3>
        <pre><?php print_r($response); ?></pre>
        <?php
            }
          }
        ?>
      </div>
    </div>
</div>
</body>
</html>
