<form class="form-inline">
<div class="form-group">
<a class="btn btn-primary" href="./">回範例列表</a>
<select onchange="location.href=this.options[this.selectedIndex].value" class="form-control">
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
</div>
</form>
