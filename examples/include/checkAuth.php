<?php
/*
 * 檢查權限，若無授權，則轉址到授權頁
 */
if (!$pixapi->checkAuth()) {
    $pixapi->getAuth();
}
