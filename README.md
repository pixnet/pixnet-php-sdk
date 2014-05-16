PIXNET SDK for PHP
==============

這個 SDK 可以讓你將 PIXNET 的相關資料快速整合進你的 PHP 專案中。
詳細 API 資訊請參考 [http://developer.pixnet.pro/](http://developer.pixnet.pro/)

This open-source library allows you to integrate PIXNET into your PHP APP.
Learn More detail at [http://developer.pixnet.pro/](http://developer.pixnet.pro/)

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

更多完整的範例在examples資料夾，請執行examples/index.php，依據步驟設定

## License
PIXNET SDK is BSD-licensed. We also provide an additional patent grant.

