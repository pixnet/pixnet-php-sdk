<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
if (!empty($_POST['series']) and isset($_POST['category_id'])) {
    $i = 0;
    foreach ($_POST['category_id'] as $id) {
        $series = $_POST['series'][$i++];
        $order[$series] = $id;
    }
    ksort($order);
    $order = implode('-', $order);
    $result = $pixapi->blog->categories->position($order);
}
$data = $pixapi->blog->categories->search();
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/../include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/../include/top.php'); ?>
    <h1 class="page-header">修改部落格分類排序</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->categories->position($ids);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>ids</p><p>分類 id 順序以 <code>,</code> 或 <code>-</code> 為分隔，放在越前面的表示圖片的順序越優先。不過在排序上分類資料夾的排序要優先於分類，所以對分類資料夾的排序指定只會影響資料夾群本身。(EX: 12394813,12938503,12395064,12351423 or 12394813-12938503-12395064-12351423 )</p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <?php if ($data['total'] > 2) { ?>
    <?php $i = 0;?>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
        <?php foreach ($data['data'] as $cat) { ?>
            <?php if ($cat['id'] > 0) { // [未分類] 不能排序?>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="query"><?= $cat['name']?></label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="series[]" placeholder="(<?= $i++?>) 請輸入新順序" value="">
                <input type="hidden" name="category_id[]" value="<?= $cat['id']?>">
            </div>
       </div>
           <?php } ?>
       <?php } ?>
       <button type="submit" class="btn btn-primary">修改分類順序</button>
    </form>
    <?php } else { ?>
        <p class="text-left">抱歉，您尚未有適量的文章分類可供操作，請先到您的<a target="_blank" href="http://panel.pixnet.cc/blog/article">管理後台</a>新增文章分類以順利使用</p>
    <?php } ?>
    <?php if (!empty($_POST['series']) and isset($_POST['category_id'])) { ?>
    <h3>實際執行</h3>
    <pre>$pixapi->blog->categories->position('<?= $order?>')</pre>
    <h3>執行結果</h3>
    <pre><?php var_dump($result) ?></pre>
    <?php } ?>
</div>
</body>
</html>
