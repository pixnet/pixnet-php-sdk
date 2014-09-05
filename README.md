PIXNET SDK for PHP
==============
這個 SDK 可以讓你將 PIXNET 的相關資料快速整合進你的 PHP 專案中。
詳細 API 資訊請參考 [http://developer.pixnet.pro/](http://developer.pixnet.pro/#!/doc/pixnetApi/oauthApi)

This open-source library allows you to integrate PIXNET into your PHP applications.
Learn More detail at [http://developer.pixnet.pro/](http://developer.pixnet.pro/#!/doc/pixnetApi/oauthApi)

##安裝 - Installation#
### 使用 Composer ###
- 增加`"pixnet/php-sdk": "@stable"`到您的`composer.json`的`require`部分.
- 執行`composer install`.

##使用 - Usage#
###在使用之前，請先至 PIXNET Developer 註冊新的 APP。
[http://developer.pixnet.pro/#!/apps](http://developer.pixnet.pro/#!/apps)

申請完成會拿到以下兩把鑰匙

 1. Consumer Key(client_id)
 2. Consumer Secret

並且你需要設定一個Registered Callback URL網址

### 使用 Composer ###
參考以下的 code 把必要參數丟進 SDK 中就可以開始使用了
```php
require_once(__DIR__ . '/vendor/autoload.php');

$pixapi = new PixAPI(array(
  'key'  => 'your consumer key',
  'secret' => 'your consumer secret',
  'callback' => 'your registered callback url'
));
```

### 未使用 Composer ###
```php
require_once(__DIR__ . '/src/PIXNET/Loader.php');

$pixapi = new PixAPI(array(
  'key'  => 'your consumer key',
  'secret' => 'your consumer secret',
  'callback' => 'your registered callback url'
));
```

##更多範例
更多完整的範例在examples資料夾，請執行examples/index.php，依據步驟設定

## 聯絡我們

Email: pixnetapi@pixnet.tw
Twitter: @pixnetapi

##快速查詢用法

###部落格
```php
- 列出部落格資訊 $pixapi->blog->info();
- 查詢其他部落格公開資訊 $pixapi->blog->info($username);
- 取得部落格全站分類 $pixapi->blog->siteCategories();
- 取得建議標籤 $pixapi->blog->suggestedTags($username = '');
```
####部落格分類
```php
- 取得部落格所有分類 $pixapi->blog->categories->search();
- 取得部落格單一分類 $pixapi->blog->categories->search($id, $is_folder = false);
- 新增部落格分類 $pixapi->blog->categoriescreate($name, $is_folder = false, $options = array());
- 修改部落格分類 $pixapi->blog->categories->update($id, $name, $is_folder = false, $options = array());
- 刪除部落格分類 $pixapi->blog->categories->delete($id, $is_folder = false);
- 修改部落格分類排序 $pixapi->blog->categories->position($ids);
```
####部落格文章
```php
- 取得部落格個人所有文章 $pixapi->blog->articles->search($options);
- 取得部落格個人單一文章 $pixapi->blog->articles->search($id);
- 取得指定文章之相關文章 $pixapi->blog->articles->related($id, $options = array());
- 取得指定文章之留言 $pixapi->blog->articles->comments($id, $options = array());
- 新增文章 $pixapi->blog->articles->create($title, $body, $options);
- 修改文章 $pixapi->blog->articles->update($article_id, $title, $body, $options);
- 刪除文章 $pixapi->blog->articles->delete($id);
- 列出部落格最新文章 $pixapi->blog->articles->latest($options = array());
- 列出部落格熱門文章 $pixapi->blog->articles->hot($options = array());
```
####部落格文章留言
```php
- 列出文章留言 $pixapi->blog->comments->search($options = array());
- 讀取單一留言 $pixapi->blog->comments->search($id);
- 新增文章留言 $pixapi->blog->comments->create($user, $article_id, $body, $options);
- 回覆文章留言 $pixapi->blog->comments->reply($id, $body);
- 將留言設為公開 $pixapi->blog->comments->open($id);
- 將留言設為悄悄話 $pixapi->blog->comments->close($id);
- 將留言設為廣告留言 $pixapi->blog->comments->markSpam($id);
- 將留言設為非廣告留言 $pixapi->blog->comments->markHam($id);
- 刪除文章留言 $pixapi->blog->comments->delete($id);
- 列出文章最新留言 $pixapi->blog->comments->latest($options = array());
```

###好友互動
```php
- 好友動態 $pixapi->friend->news($option = array());
```
####群組
```php
- 列出好友群組 $pixapi->friend->groups->search($option = array());
- 新增好友群組 $pixapi->friend->groups->create($name);
- 修改好友群組 $pixapi->friend->groups->update($id, $name);
- 刪除好友群組 $pixapi->friend->groups->delete($id);
```
####好友名單
```php
- 列出好友名單 $pixapi->friend->friendships->search($option = array());
- 新增好友 $pixapi->friend->friendships->create($name);
- 加入群組 $pixapi->friend->friendships->appendGroup($name, $id);
- 移除群組 $pixapi->friend->friendships->removeGroup($name, $id);
- 刪除好友 $pixapi->friend->friendships->delete($name);
```
####訂閱
```php
- 列出訂閱名單 $pixapi->friend->subscriptions->search($option = array());
- 新增訂閱 $pixapi->friend->subscriptions->create($name, $options = array());
- 加入訂閱群組 $pixapi->friend->subscriptions->joinSubscriptionGroup($name, $group_ids = array());
- 離開訂閱群組 $pixapi->friend->subscriptions->leaveSubscriptionGroup($name, $group_ids = array());
- 刪除訂閱 $pixapi->friend->subscriptions->delete($name);
```
####訂閱群組
```php
- 列出訂閱群組 $pixapi->friend->subscriptionGroups->search();
- 新增訂閱群組 $pixapi->friend->subscriptionGroups->create($name);
- 修改訂閱群組 $pixapi->friend->subscriptionGroups->update($id, $name);
- 刪除訂閱群組 $pixapi->friend->subscriptionGroups->delete($id);
- 修改訂閱群組排序 $pixapi->friend->subscriptionGroups->position($ids);
```

###黑名單
```php
- 列出黑名單 $pixapi->block->search();
- 新增黑名單 $pixapi->block->create($user);
- 刪除黑名單 $pixapi->block->delete($user);
```

###留言板
```php
- 列出留言版留言 $pixapi->guestbook->search($option = array());
- 讀取單一留言 $pixapi->guestbook->search($id);
- 新增留言版留言 $pixapi->guestbook->create($name, $body, $options);
- 回覆留言版留言 $pixapi->guestbook->reply($id, $body);
- 將留言設為公開 $pixapi->guestbook->open($id);
- 將留言設為悄悄話 $pixapi->guestbook->close($id);
- 將留言設為廣告 $pixapi->guestbook->markSpam($id);
- 將留言設為非廣告 $pixapi->guestbook->markHam($id);
- 刪除留言版留言 $pixapi->guestbook->delete($id);
```

###首頁
####文章
```php
- 列出文章專欄 $pixapi->mainpage->blog->columns();
- 列出全站熱門 $pixapi->mainpage->blog->hot($options);
- 列出全站最新 $pixapi->mainpage->blog->latest($options);
- 列出全站近期影片 $pixapi->mainpage->blog->hotWeekly($options);
```
####相簿
```php
- 列出相簿專欄 $pixapi->mainpage->album->columns();
- 列出全站熱門 $pixapi->mainpage->album->hot($options);
- 列出全站最新 $pixapi->mainpage->album->latest($options);
- 列出全站近期影片 $pixapi->mainpage->album->hotWeekly($options);
```
####影片
```php
- 列出全站熱門 $pixapi->mainpage->video->hot($options);
- 列出全站最新 $pixapi->mainpage->video->latest($options);
- 列出全站近期影片 $pixapi->mainpage->video->hotWeekly($options);
```
###使用者
```php
- 取得使用者資訊 $pixapi->user->info();
- 查詢其他使用者公開資訊 $pixapi->user->info(UserName);
```
###索引
```php
- 取得API使用次數資訊 $pixapi->index->rate();
- 取得API Server時間資訊 $pixapi->index->now();
```

## License
PIXNET SDK is BSD-licensed. We also provide an additional patent grant.
