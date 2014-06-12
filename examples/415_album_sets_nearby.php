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
    <h1 class="page-header">取得附近的相簿列表</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->sets->nearby($name, $lat, $lon, $options = array());</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
        <li>
        <p>name</p>
        <p>使用者名稱</p>
        </li>
        <li>
        <p>lat</p>
        <p>WGS84 坐標系緯度，例如 25.058172</p>
        </li>
        <li>
        <p>lon</p>
        <p>WGS84 坐標系經度，例如 121.535304</p>
        </li>
        </ul>
        <p>選填參數</p>
        <ul>
        <li><p>page</p>
        <p>頁數, 預設為1</p></li>
        <li><p>per_page</p>
        <p>每頁幾筆, 預設為100</p></li>
        <li><p>trim_user</p>
        <p>是否每本相簿都要回傳使用者資訊，若設定為 1 則不回傳。預設為 0</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-inline" role="form" method="POST">
      <div class="form-group">
        <label class="sr-only" for="query">使用者名稱(必填)</label>
        <input type="text" class="form-control" id="query" name="name" placeholder="請輸入使用者名稱" value="<?= $_POST['name']? $_POST['name'] : 'emmademo' ?>">
        <label class="sr-only" for="query">緯度 lat</label>
        <input type="text" class="form-control" id="query" name="lat" placeholder="請輸入緯度" value="<?= $_POST['lat']? $_POST['lat'] : '25.058172' ?>">
        <label class="sr-only" for="query">經度 lon</label>
        <input type="text" class="form-control" id="query" name="lon" placeholder="請輸入經度" value="<?= $_POST['lon']? $_POST['lon'] : '121.535304' ?>">
      </div>
      <button type="submit" class="btn btn-primary">取得附近的相簿列表</button>
    </form>
    <?php if (!empty($_POST['name']) and !empty($_POST['lat']) and !empty($_POST['lon'])) {?>
    <h3>實際執行</h3>
    <pre>
        $options = array('distance_max' => 3500);
        $pixapi->album->sets->nearby(<?= htmlspecialchars($_POST['name'])?>, <?= $_POST['lat'] ?>, <?= $_POST['lon']?>, $options)
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->sets->nearby($_POST['name'], $_POST['lat'], $_POST['lon'], array('distance_max' => 3500))); ?></pre>
    <?php }?>
</div>
</body>
</html>
