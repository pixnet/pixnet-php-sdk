<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/../include/checkAuth.php');
$id = $_GET['id'];
if ('' != $id) {
    $data = $pixapi->blog->articles->search($id)['data'];
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once(__DIR__ . '/../include/header.php'); ?>
</head>
<body>
<div class="container">
    <?php require_once(__DIR__ . '/../include/top.php'); ?>
    <h1 class="page-header">修改文章</h1>
    <h3>呼叫方式</h3>
    <pre>$pixapi->blog->articles->update($article_id, $title, $body, $options);</pre>
    <div class="well">
        <p>必填參數</p>
        <ul>
            <li><p>article_id</p><p>文章 id，數字</p></li>
            <li><p>title</p><p>文章標題，文字</p></li>
            <li><p>body</p><p>文章內容，文字</p></li>
        </ul>
        <p>選填參數</p>
        <ul>
            <li><p>status</p><p>文章狀態, 0: 刪除, 1: 草稿, 2: 公開, 3: 密碼, 4: 隱藏, 5: 好友, 7: 共同作者</p></li>
            <li><p>public_at</p><p>公開時間, 這個表示文章的發表時間, 以 UNIX timestamp 的方式輸入, 預設為現在時間</p></li>
            <li><p>category_id</p><p>個人分類, 數字, 請先到 <a href="/#!/doc/pixnetApi/blogCategories" target="_blank">BlogCategory</a> 裡找自己的分類列表, 預設是0</p></li>
            <li><p>site_category_id</p><p>站台分類, 數字, 預設是0</p></li>
            <li><p>use_nl2br</p><p>是否使用 nl2br, 預設是0 (1 → 使用 nl2br, 0 → 不使用)</p></li>
            <li><p>comment_perm</p><p>可留言權限. 0: 關閉留言, 1: 開放所有人留言, 2: 僅開放會員留言, 3:開放好友留言. 預設會看 Blog 整體設定</p></li>
            <li><p>comment_hidden</p><p>預設留言狀態. 0: 公開, 1: 強制隱藏. 預設為0(公開)</p></li>
            <li><p>tags</p><p>標籤, 以”,”為分隔, 如”foo,bar”</p></li>
            <li><p>thumb</p><p>文章縮圖網址, 會影響 oEmbed 與 SNS (Twitter, Facebook, Plurk …) 抓到的縮圖</p></li>
            <li><p>trackback</p><p>發送引用通知, 可以輸入複數網站(用空白分隔)</p></li>
            <li><p>password</p><p>當 status 被設定為 3 時需要輸入這個參數以設定為此文章的密碼</p></li>
            <li><p>password_hint</p><p>當 status 被設定為 3 時需要輸入這個參數以設定為此文章的密碼提示</p></li>
            <li><p>friend_group_ids</p><p>當 status 被設定為 5 時可以輸入這個參數以設定此文章可閱讀的好友群組, 預設不輸入代表所有好友</p></li>
            <li><p>notify_twitter</p><p>動態發送至 Twitter. 必須先有同步關係才能發送, 預設為部落格全域設定. 請參考 <a href="http://panel.pixnet.cc/blog/config" title="http://panel.pixnet.cc/blog/config">http://panel.pixnet.cc/blog/config</a></p></li>
            <li><p>notify_facebook</p><p>動態發送至 Facebook. 必須先有同步關係才能發送, 預設為部落格全域設定. 請參考 <a href="http://panel.pixnet.cc/blog/config" title="http://panel.pixnet.cc/blog/config">http://panel.pixnet.cc/blog/config</a></p></li>
        </ul>
    </div>
    <h3><a href="#execute" name="execute">實際測試</a></h3>
    <form action="#execute" class="form-horizontal" role="form" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">準備修改的文章</label>
            <div class="col-sm-4">
              <select class="form-control" id="id" name="id" onchange="location.href=this.options[this.selectedIndex].value">
              <option value="">請選擇</option>
              <?php
              $articles = $pixapi->blog->articles->latest(array('limit' => 5))['data'];
              foreach ($articles as $article) {
                if ($article['id'] > 0) {
              ?>
                  <option value="?id=<?= $article['id'] ?>" <?= ($id == $article['id']) ? 'selected' : ''; ?>><?= $article['title'] ?></option>
              <?php
                }
              }
              ?>
              </select>
              (只顯示最新5筆)
              </div>
          </div>
          <?php
          if ('' != $id) {
          ?>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">主旨(必填)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="query" name="query" placeholder="請輸入主旨" value="<?= $data['title']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="query">內文(必填)</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="query2" name="query2"><?= $data['body']; ?>&nbsp;</textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">建立</button>
            </div>
          </div>
          <?php
          }
          ?>
    </form>
    <?php
        $query = $_POST['query'];
        $query2 = $_POST['query2'];
        if ('' != $query and '' != $query2) {
    ?>
    <h3>執行</h3>
    <pre>$pixapi->blog->articles->update('<?= $id; ?>', '<?= $query; ?>', '<?= $query2; ?>');</pre>
    <h3>執行結果</h3>
    <pre><?php print_r($pixapi->blog->articles->update($id, $query, $query2)); ?></pre>
    <?php
        }
    ?>
</div>
</body>
</html>
