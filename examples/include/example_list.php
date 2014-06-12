<?php
$examples_list = array(
    '部落格' => array(
        array(
            'name' => '資訊',
            'examples' => array(
                '取得部落格資訊' => '301_blog_info.php',
                '查詢其他部落格公開資訊' => '302_blog_info.php',
                '取得部落格全站分類' => '303_blog_site_categories.php',
            )
        ),
        array(
            'name' => '文章分類',
            'examples' => array(
                '取得部落格所有分類/資料夾' => '311_blog_categories_search.php',
                '取得部落格單一分類/資料夾' => '312_blog_categories_search.php',
                '新增部落格分類/資料夾-簡易' => '313_blog_categories_create.php',
                '新增部落格分類/資料夾-進階' => '314_blog_categories_create.php',
                '修改分類/資料夾' => '315_blog_categories_update.php',
                '刪除分類/資料夾' => '316_blog_categories_delete.php',
                '修改部落格分類排序' => '317_blog_categories_position.php'
            )
        ),
        array(
            'name' => '文章',
            'examples' => array(
                '取得部落格個人所有文章' => '321_blog_articles_search.php',
                '取得部落格個人單一文章' => '322_blog_articles_search.php',
                '取得指定文章之相關文章' => '323_blog_articles_related.php',
                '取得指定文章之留言' => '324_blog_articles_comments.php',
                '新增個人文章' => '325_blog_articles_create.php',
                '修改個人文章' => '326_blog_articles_update.php',
                '刪除個人文章' => '327_blog_articles_delete.php',
                '取得部落格最新文章' => '328_blog_articles_latest.php',
                '取得部落格熱門文章' => '329_blog_articles_hot.php'
            )
        ),
        array(
            'name' => '文章留言',
            'examples' => array(
                '列出文章留言' => '330_blog_comments_search.php',
                '讀取單一留言' => '331_blog_comments_search.php',
                '新增文章留言' => '332_blog_comments_create.php',
                '回覆文章留言' => '333_blog_comments_reply.php',
                '將留言設為公開' => '334_blog_comments_open.php',
                '將留言設為悄悄話' => '335_blog_comments_close.php',
                '將留言設為廣告留言' => '336_blog_comments_mark_spam.php',
                '將留言設為非廣告留言' => '337_blog_comments_mark_ham.php',
                '刪除文章留言' => '338_blog_comments_delete.php',
                '列出文章最新留言' => '339_blog_comments_latest.php'
            )
        )
    ),
    '相簿' => array(
        array(
            'name' => '資訊',
            'examples' => array(
                '取得相簿全站分類' => '401_album_site_categories.php',
            )
        ),
        array(
            'name' => '相簿',
            'examples' => array(
            )
        ),
        array(
            'name' => '相簿列表',
            'examples' => array(
                '取得相簿列表' => '421_album_sets_search.php',
                '取得個人單一相簿' => '422_album_sets_search.php',
                '取得單一相簿內的所有相片' => '423_album_sets_elements.php',
                '取得相簿內的所有留言' => '424_album_sets_comments.php',
                '取得附近的相簿列表' => '425_album_sets_nearby.php',
                '新增相簿' => '426_album_sets_create.php',
                '修改相簿' => '427_album_sets_update.php',
                '修改相簿順序' => '428_album_sets_position.php',
                '刪除相簿' => '429_album_sets_delete.php',
            )
        ),
        array(
            'name' => '相簿資料夾',
            'examples' => array(
                '取得相簿資料夾列表' => '430_album_folders_search.php',
                '取得單一相簿資料夾' => '431_album_folders_search.php',
                '建立相簿資料夾' => '432_album_folders_create.php',
                '修改相簿資料夾' => '433_album_folders_update.php',
                '刪除相簿資料夾' => '434_album_folders_delete.php',
            )
        ),
        array(
            'name' => '相片',
            'examples' => array(
            )
        ),
        array(
            'name' => '留言',
            'examples' => array(
            )
        ),
        array(
            'name' => '人臉標記',
            'examples' => array(
            )
        )
    ),
    '好友互動' => array(
        array(
            'name' => '好友互動',
            'examples' => array(
                '好友動態' => '501_friend_news.php'
            )
        ),
        array(
            'name' => '群組',
            'examples' => array(
                '列出好友群組' => '511_friend_groups_search.php',
                '新增好友群組' => '512_friend_groups_create.php',
                '修改好友群組' => '513_friend_groups_update.php',
                '刪除好友群組' => '514_friend_groups_delete.php',
            )
        ),
        array(
            'name' => '好友名單',
            'examples' => array(
                '列出好友名單' => '521_friend_frienships_search.php',
                '新增好友'     => '522_friend_frienships_create.php',
                '加入群組'     => '523_friend_frienships_append.php',
                '移除群組'     => '524_friend_frienships_remove.php',
                '刪除好友'     => '525_friend_frienships_delete.php',
            )
        ),
        array(
            'name' => '訂閱',
            'examples' => array(
                '列出訂閱名單' => '531_friend_subscriptions_search.php',
                '新增訂閱'     => '532_friend_subscriptions_create.php',
                '加入訂閱群組' => '533_friend_subscriptions_join.php',
                '離開訂閱群組' => '534_friend_subscriptions_leave.php',
                '刪除訂閱'     => '535_friend_subscriptions_delete.php',
            )
        ),
        array(
            'name' => '訂閱群組',
            'examples' => array(
                '列出訂閱群組'     => '541_friend_subscriptions_groups_search.php',
                '新增訂閱群組'     => '542_friend_subcriptions_groups_create.php',
                '修改訂閱群組'     => '543_friend_subcriptions_groups_update.php',
                '刪除訂閱群組'     => '544_friend_subcriptions_groups_delete.php',
                '修改訂閱群組排序' => '545_friend_subcriptions_groups_position.php',
            )
        )
    ),
    '黑名單' => array(
        array(
            'name' => '黑名單',
            'examples' => array(
                '列出黑名單' => '601_block_search.php',
                '新增黑名單' => '602_block_create.php',
                '刪除黑名單' => '603_block_delete.php',
            )
        )
    ),
    '留言板' => array(
        array(
            'name' => '留言板',
            'examples' => array(
                '列出留言版留言' => '701_guestbook_search.php',
                '讀取單一留言' => '702_guestbook_search.php',
                '新增留言版留言' => '703_guestbook_create.php',
                '回覆留言版留言' => '704_guestbook_reply.php',
                '將留言設為公開' => '705_guestbook_open.php',
                '將留言設為悄悄話' => '706_guestbook_close.php',
                '將留言設為廣告' => '707_guestbook_mark_spam.php',
                '將留言設為非廣告' => '708_guestbook_mark_ham.php',
                '刪除留言版留言' => '709_guestbook_delete.php',
            )
        )
    ),
    '首頁' => array(
        array(
            'name' => '文章',
            'examples' => array(
                '列出文章專欄' => '801_mainpage_blog_olumns.php',
                '列出全站熱門、最新、近期文章' => '802_mainpage_blog_hot.php',
            )
        ),
        array(
            'name' => '相簿',
            'examples' => array(
                '列出相簿專欄' => '811_mainpage_album_columns.php',
                '列出全站熱門、最新、近期相簿' => '812_mainpage_album_hot.php',
            )
        ),
        array(
            'name' => '影片',
            'examples' => array(
                '列出全站熱門、最新、近期影片' => '821_mainpage_video_hot.php',
            )
        )
    ),
    '使用者' => array(
        array(
            'name' => '資訊',
            'examples' => array(
                '取得使用者資訊' => '201_user_info.php',
                '查詢其他使用者公開資訊' => '202_user_info.php'
            )
        )
    ),
    '索引' => array(
        array(
            'name' => '資訊',
            'examples' => array(
                '取得API使用次數資訊' => '101_index_rate.php',
                '取得API Server時間資訊' => '102_index_now.php'
            )
        )
    )
);
