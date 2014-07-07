<?php
if (file_exists(__DIR__ . '/init.inc.php')) {
    require_once(__DIR__ . '/bootstrap.php');
}
if ('' != $_GET['logout']) {
    $pixapi->resetSession();
    header('location:?');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/include/header.php'); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1 class="page-header">Getting started</h1>
    <?php if (file_exists(__DIR__ . '/init.inc.php')) { ?>
    <?php if ($pixapi->checkAuth()) { ?>
    <div class="alert alert-success">已經取得使用者授權，您登入的是<?= $pixapi->getUserName(); ?> <a href="?logout=1">登出</a></div>
    <?php } else { ?>
    <div class="alert alert-danger"><a href="auth.php">尚未取得授權，按此前往授權</a></div>
    <?php }?>
    <?php } else { ?>
    <h3>1.建立應用程式</h3>
    <div class="well"><a href="http://developer.pixnet.pro/#!/apps" target="_blank">按此前往建立</a></div>
    <h3>2.建立設定檔案，複製init.inc.sample.php 成 init.inc.php，並填入相關參數</h3>
    <div class="alert alert-danger">您還沒建立設定檔案</div>
    <pre>$pixapi = new PixAPI(array(
  'key'  => '您所建立APP的Consumer Key (client_id)',
  'secret' => '您所建立APP的Comsumer Secret',
  'callback' => '您所建立APP的中填寫的Registered Callback URL，必須一致'
));</pre>
    <?php }?>
    <div class="panel panel-default">
        <div class="panel-heading">範例列表</div>
        <div class="panel-body">
            <ul class="nav nav-tabs" id="example_tabs">
<?php
$j = 0;
$tab = intval($_GET['tab']);
foreach ($examples_list as $group_name => $group) {
    $i = 0;
?>
                <li class="<?= ($tab == $j) ? 'active' : ''; ?>"><a href="#tab<?= $j ?>" data-toggle="tab"><?= $group_name; ?></a></li>
<?php
    $j++;
}
?>
                <li class=""><a href="#tabhelp" data-toggle="tab">安裝說明</a></li>
            </ul>

            <div class="tab-content">
<?php
$j = 0;
foreach ($examples_list as $group_name => $group) {
    $i = 0;
?>
                <div class="tab-pane <?= ($tab == $j) ? 'active' : ''; ?>" id="tab<?= $j ?>">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>子分類</th>
                                <th>範例</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    foreach ($group as $example) {
?>
                        <tr>
                            <td class="col-md-2"><?= $example['name']; ?></td>
                            <td class="col-md-10">
                                <ul>

<?php
        foreach ($example['examples'] as $name =>$url ) {
?><li>
                                    <a href="<?= $url; ?>?tab=<?= $j; ?>"><?= $name; ?></a>
                                    </li>
<?php
        }
?>

                            </ul></td>
                        </tr>
<?php
    }
?>
                        </tbody>
                    </table>
                </div>
<?php
    $j++;
}
?>
                <div class="tab-pane" id="tabhelp">
                    <a href="https://github.com/pixnet/pixnet-php-sdk/blob/master/README.md" target="_blank">安裝說明</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('body').ready(function(){
    var url_arr = location.href.split('/');
    var anchor = url_arr[url_arr.length - 1];
    $('a[href="' + anchor + '"]').tab('show');
});
$('a[data-toggle="tab"]').click(function(){
    window.history.pushState("", "", this.href);
});
</script>
</body>
</html>
