<?php
require_once(__DIR__ . '/bootstrap.php');
require_once(__DIR__ . '/include/checkAuth.php');
if (isset($_POST['username']) and isset($_POST['lon']) and isset($_POST['lat'])) {
    $options = ['distance_max' => 50000];
    $result = $pixapi->album->elements->nearby($_POST['username'],$_POST['lat'],$_POST['lon'], $options);
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
    <h1 class="page-header">搜尋附近的相片（影音）</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->elements->nearby($set_id, $ids);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>username</p><p>指定要回傳的使用者資訊</p></li>
            <li><p>lat</p><p>WGS84 坐標系緯度，例如 25.058172</p></li>
            <li><p>lon</p><p>WGS84 坐標系經度，例如 121.535304</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>distance_min</p><p>回傳相片／影音所在地和指定經緯度距離之最小值，單位為公尺。預設為 0 公尺，上限為 50000 公尺</p></li>
            <li><p>distance_max</p><p>回傳相片／影音所在地和指定經緯度距離之最大值，單位為公尺。預設為 0 公尺，上限為 50000 公尺</p></li>
            <li><p>page</p><p>頁數，預設為 1</p></li>
            <li><p>per_page</p><p>每頁幾筆，預設為 100 筆</p></li>
            <li><p>with_detail</p><p>是否傳回詳細資訊，指定為 1 時將傳回相片／影音完整資訊及所屬相簿資訊。預設為 0</p></li>
            <li><p>type</p><p>指定要回傳的類別。 pic ：只顯示圖片， video ：只顯示影片。</p></li>
            <li><p>trim_user</p><p>是否每個相片／影音都要回傳使用者資訊，若設定為 1 則不回傳。預設為 0</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">使用者名稱</label>
        <div class="col-sm-5">
            <input class="form-control" name="username" value="emmatest">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">緯度</label>
        <div class="col-sm-5">
            <input class="form-control" name="lat" value="25.058172">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">經度</label>
        <div class="col-sm-5">
            <input class="form-control" name="lon" value="121.535304"> 
        </div>
      </div>
      <button type="submit" class="btn btn-primary">修改相片（影音）順序</button>
    </form>
    <?php if (isset($result)) {?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->elements->nearby('<?= $_POST['username']?>', <?= $_POST['lat']?>, <?= $_POST['lon']?>, ['distance_max' => 50000])
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($result); ?></pre>
    <?php }?>
</div>
</body>
</html>
