<a href="./">回範例列表</a> 快速跳至範例
<select onchange="location.href=this.options[this.selectedIndex].value">
<?php

    $script_name = end(explode('/', $_SERVER["SCRIPT_NAME"]));

    foreach ($examples_list as $group_name => $group) {
        foreach ($group as $example) {
?>
    <optgroup label="<?= $group_name . '/' . $example['name']; ?>">
    <?php
            foreach ($example['examples'] as $apiname =>$url ) {
    ?>
    <option value="<?= $url; ?>" <?= ($script_name == $url) ? 'selected' : ''?>><?= $apiname; ?></option>
    <?php
            }
    ?>
    </optgroup>
<?php
        }
    }
?>
</select>
