<?php
$examples_list = array(
    '部落格' => array(
        array(
            'name' => '資訊',
            'examples' => array(
                '取得部落格資訊' => 'blog/info.php',
                '查詢其他部落格公開資訊' => 'blog/other_info.php',
                '取得部落格全站分類' => 'blog/site_categories.php',
                '取得建議標籤' => 'blog/suggested_tags.php',
            )
        ),
        array(
            'name' => '文章分類',
            'examples' => array(
                '取得部落格所有分類/資料夾' => 'blog/categories_search.php',
                '取得部落格單一分類/資料夾' => 'blog/categories_search_2.php',
                '新增部落格分類/資料夾-簡易' => 'blog/categories_create.php',
                '新增部落格分類/資料夾-進階' => 'blog/categories_create_2.php',
                '修改分類/資料夾' => 'blog/categories_update.php',
                '刪除分類/資料夾' => 'blog/categories_delete.php',
                '修改部落格分類排序' => 'blog/categories_position.php'
            )
        ),
        array(
            'name' => '文章',
            'examples' => array(
                '取得部落格個人所有文章' => 'blog/articles_search.php',
                '取得部落格個人單一文章' => 'blog/articles_search_2.php',
                '取得指定文章之相關文章' => 'blog/articles_related.php',
                '取得指定文章之留言' => 'blog/articles_comments.php',
                '新增個人文章' => 'blog/articles_create.php',
                '修改個人文章' => 'blog/articles_update.php',
                '刪除個人文章' => 'blog/articles_delete.php',
                '取得部落格最新文章' => 'blog/articles_latest.php',
                '取得部落格熱門文章' => 'blog/articles_hot.php'
            )
        ),
        array(
            'name' => '文章留言',
            'examples' => array(
                '列出文章留言' => 'blog/comments_search.php',
                '讀取單一留言' => 'blog/comments_search_2.php',
                '新增文章留言' => 'blog/comments_create.php',
                '回覆文章留言' => 'blog/comments_reply.php',
                '將留言設為公開' => 'blog/comments_open.php',
                '將留言設為悄悄話' => 'blog/comments_close.php',
                '將留言設為廣告留言' => 'blog/comments_mark_spam.php',
                '將留言設為非廣告留言' => 'blog/comments_mark_ham.php',
                '刪除文章留言' => 'blog/comments_delete.php',
                '列出文章最新留言' => 'blog/comments_latest.php'
            )
        )
    ),
    '相簿' => array(
        array(
            'name' => '資訊',
            'examples' => array(
                '取得相簿全站分類' => 'album/site_categories.php',
                '取得相簿個人首頁資訊' => 'album/main.php',
                '列出相簿個人設定' => 'album/config.php',
            )
        ),
        array(
            'name' => '相簿',
            'examples' => array(
                '取得相簿首頁的相簿列表' => 'album/setfolders_search.php',
                '修改相簿首頁的相簿順序' => 'album/setfolders_position.php',
            )
        ),
        array(
            'name' => '相簿列表',
            'examples' => array(
                '取得相簿列表' => 'album/sets_search.php',
                '取得個人單一相簿' => 'album/sets_search_2.php',
                '取得單一相簿內的所有相片' => 'album/sets_elements.php',
                '取得相簿內的所有留言' => 'album/sets_comments.php',
                '取得附近的相簿列表' => 'album/sets_nearby.php',
                '新增相簿' => 'album/sets_create.php',
                '修改相簿' => 'album/sets_update.php',
                '修改相簿順序' => 'album/sets_position.php',
                '刪除相簿' => 'album/sets_delete.php',
            )
        ),
        array(
            'name' => '相簿資料夾',
            'examples' => array(
                '取得相簿資料夾列表' => 'album/folders_search.php',
                '取得單一相簿資料夾' => 'album/folders_search_2.php',
                '建立相簿資料夾' => 'album/folders_create.php',
                '修改相簿資料夾' => 'album/folders_update.php',
                '刪除相簿資料夾' => 'album/folders_delete.php',
            )
        ),
        array(
            'name' => '相片',
            'examples' => array(
                '新增相片' => 'album/element_create.php',
                '搜尋相片（影音）' => 'album/element_search.php',
                '搜尋單一相片（影音）' => 'album/element_search_2.php',
                '修改單一相片（影音）' => 'album/element_modify.php',
                '刪除單一相片（影音）' => 'album/element_delete.php',
                '調整相片（影音）順序' => 'album/element_position.php',
                '搜尋附近的相片（影音）' => 'album/element_nearby.php'
            )
        ),
        array(
            'name' => '相片留言',
            'examples' => array(
                '取得相片上單一留言' => 'album/elements_comments_search.php',
                '取得相片上所有留言' => 'album/elements_comments_search_2.php',
                '取得相簿內所有相片留言' => 'album/elements_comments_search_3.php',
                '新增相片留言' => 'album/elements_comments_create.php',
                '將留言設為廣告留言' => 'album/elements_comments_markspam.php',
                '將留言設為非廣告留言' => 'album/elements_comments_unmarkspam.php',
                '刪除相片留言' => 'album/elements_comments_delete.php',
            )
        ),
        array(
            'name' => '相簿留言',
            'examples' => array(
                '取得相簿留言' => 'album/comments_search.php',
                '新增相簿留言' => 'album/comments_create.php',
                '讀取單一留言' => 'album/comments_search_2.php',
                '將留言設為廣告留言' => 'album/comments_markspam.php',
                '將留言設為非廣告留言' => 'album/comments_unmarkspam.php',
                '刪除相簿留言' => 'album/comments_delete.php',
            )
        ),
        array(
            'name' => '人臉標記',
            'examples' => array(
                '新增人臉標記' => 'album/faces_create.php',
                '更新人臉標記' => 'album/faces_update.php',
                '刪除人臉標記' => 'album/faces_delete.php',
            )
        )
    ),
    '好友互動' => array(
        array(
            'name' => '好友互動',
            'examples' => array(
                '好友動態' => 'friend/news.php'
            )
        ),
        array(
            'name' => '群組',
            'examples' => array(
                '列出好友群組' => 'friend/groups_search.php',
                '新增好友群組' => 'friend/groups_create.php',
                '修改好友群組' => 'friend/groups_update.php',
                '刪除好友群組' => 'friend/groups_delete.php',
            )
        ),
        array(
            'name' => '好友名單',
            'examples' => array(
                '列出好友名單' => 'friend/frienships_search.php',
                '新增好友'     => 'friend/frienships_create.php',
                '加入群組'     => 'friend/frienships_append.php',
                '移除群組'     => 'friend/frienships_remove.php',
                '刪除好友'     => 'friend/frienships_delete.php',
            )
        ),
        array(
            'name' => '訂閱',
            'examples' => array(
                '列出訂閱名單' => 'friend/subscriptions_search.php',
                '新增訂閱'     => 'friend/subscriptions_create.php',
                '加入訂閱群組' => 'friend/subscriptions_join.php',
                '離開訂閱群組' => 'friend/subscriptions_leave.php',
                '刪除訂閱'     => 'friend/subscriptions_delete.php',
            )
        ),
        array(
            'name' => '訂閱群組',
            'examples' => array(
                '列出訂閱群組'     => 'friend/subscriptions_groups_search.php',
                '新增訂閱群組'     => 'friend/subcriptions_groups_create.php',
                '修改訂閱群組'     => 'friend/subcriptions_groups_update.php',
                '刪除訂閱群組'     => 'friend/subcriptions_groups_delete.php',
                '修改訂閱群組排序' => 'friend/subcriptions_groups_position.php',
            )
        )
    ),
    '黑名單' => array(
        array(
            'name' => '黑名單',
            'examples' => array(
                '列出黑名單' => 'block/search.php',
                '新增黑名單' => 'block/create.php',
                '刪除黑名單' => 'block/delete.php',
            )
        )
    ),
    '留言板' => array(
        array(
            'name' => '留言板',
            'examples' => array(
                '列出留言版留言' => 'guestbook/search.php',
                '讀取單一留言' => 'guestbook/search_2.php',
                '新增留言版留言' => 'guestbook/create.php',
                '回覆留言版留言' => 'guestbook/reply.php',
                '將留言設為公開' => 'guestbook/open.php',
                '將留言設為悄悄話' => 'guestbook/close.php',
                '將留言設為廣告' => 'guestbook/mark_spam.php',
                '將留言設為非廣告' => 'guestbook/mark_ham.php',
                '刪除留言版留言' => 'guestbook/delete.php',
            )
        )
    ),
    '首頁' => array(
        array(
            'name' => '文章',
            'examples' => array(
                '列出文章專欄' => 'mainpage/blog_olumns.php',
                '列出全站熱門、最新、近期文章' => 'mainpage/blog_hot.php',
            )
        ),
        array(
            'name' => '相簿',
            'examples' => array(
                '列出相簿專欄' => 'mainpage/album_columns.php',
                '列出全站熱門、最新、近期、精選相簿' => 'mainpage/album_hot.php',
            )
        ),
        array(
            'name' => '影片',
            'examples' => array(
                '列出全站熱門、最新、近期影片' => 'mainpage/video_hot.php',
            )
        )
    ),
    '使用者' => array(
        array(
            'name' => '資訊',
            'examples' => array(
                '取得使用者資訊' => 'user/info.php',
                '查詢其他使用者公開資訊' => 'user/other_info.php',
                '檢查使用者手機驗證狀態' => 'user/cellphone_verification.php'
            )
        ),
        array(
            'name' => '通知',
            'examples' => array(
                '取得通知內容' => 'user/notification_list.php',
                '設定通知為已讀' => 'user/mark_notification_as_read.php',
            )
        )
    ),
    '索引' => array(
        array(
            'name' => '資訊',
            'examples' => array(
                '取得API使用次數資訊' => 'index/rate.php',
                '取得API Server時間資訊' => 'index/now.php'
            )
        )
    )
);
