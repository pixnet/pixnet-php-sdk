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
    <h1 class="page-header">修改相簿</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->album->sets->update($title, $desc, <a href="http://developer.pixnet.pro/#!/doc/pixnetApi/albumSetComments" target="blank">$options</a> = array());</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
        <li><p>set_id</p>
        <p>相簿 id，數字</p></li>
        <li><p>title</p>
        <p>標題，文字</p></li>
        <li><p>description</p>
        <p>描述，文字</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
        <li><p>format</p>
        <p>格式, 支援 xml 與 json. 預設為 json</p></li>
        <li><p>permission</p>
        <p>閱讀權限，0: 完全公開 / 1: 好友相簿 / 3: 密碼相簿 / 4: 隱藏相簿 / 5: 好友群組相簿</p></li>
        <li><p>category_id</p>
        <p>相簿分類，數字，預設為0</p></li>
        <li><p>is_lockright</p>
        <p>是否鎖右鍵，1: 上鎖. 0: 不上鎖，預設為0</p></li>
        <li><p>allow_cc</p>
        <p>是否採用CC授權 0: copyrighted / 1: cc</p></li>
        <li><p>cancomment</p>
        <p>是否允許留言 0: 禁止留言, 1: 開放留言, 2: 限好友留言, 3: 限會員留言</p></li>
        <li><p>password</p>
        <p>相簿密碼 (當 permission 為 3 時需要)</p></li>
        <li><p>password_hint</p>
        <p>密碼提示 (當 permission 為 3 時需要)</p></li>
        <li><p>friend_group_ids</p>
        <p>好友群組ID, 以「,」 或 「-」 區隔. 例: '231423,123235,3213324', '231423-123235-3213324'. 當 permission 為 5 時需要</p></li>
        <li><p>allow_commercial_usr</p>
        <p>0: 不允許商業使用. 1: 允許商業使用, 預設為 0</p></li>
        <li><p>allow_derivation</p>
        <p>0: 不允許創作衍生著作. 1: 允許創作衍生著作, 預設為 0</p></li>
        <li><p>parent_id</p>
        <p>如果這個 parent_id 被指定, 則此相簿會放置在這個相簿資料夾底下(只能放在資料夾底下)</p></li>
        </ul>
    </div>
    <h3>實際測試</h3>
    <form class="form-horizontal" role="form" method="POST">
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">相簿 id</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="query" name="set_id" placeholder="請輸入相簿 id" value="<?= $_POST['set_id']? $_POST['set_id'] : '' ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">標題</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="query" name="title" placeholder="請輸入標題" value="<?= $_POST['title']? $_POST['title'] : '' ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label" for="query">描述</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="query" name="desc" placeholder="請輸入描述" value="<?= $_POST['desc']? $_POST['desc'] : '' ?>">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">修改相簿</button>
    </form>
    <?php if (!empty($_POST['title']) and !empty($_POST['desc'])) {?>
    <h3>實際執行</h3>
    <pre>
        $pixapi->album->sets->update(<?= htmlspecialchars($_POST['set_id'])?>, <?= htmlspecialchars($_POST['title'])?>, <?= $_POST['desc'] ?>, $options)
    </pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->album->sets->update($_POST['set_id'], $_POST['title'], $_POST['desc'])); ?></pre>
    <?php }?>
</div>
</body>
</html>
