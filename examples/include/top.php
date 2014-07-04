<?php $script_name = end(explode('/', $_SERVER["SCRIPT_NAME"])); ?>
<?php $item_count = 0; ?>
<div class="btn-group">
    <a class="btn btn-primary" href="./?tab=<?= $_GET['tab']; ?>">回範例列表</a>
    <div class="btn-group">
        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
        範例選單
        <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <?php foreach ($examples_list as $group_name => $group) { ?>
                <?php $item_count++; ?>
            <li class="dropdown-submenu">
                <a tabindex="-1" href="#"><?= $group_name ?></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <?php foreach ($group as $example) { ?>
                    <li class="dropdown-submenu">
                        <a tabindex="-1" href="#"><?= $example['name'] ?></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <?php if (count($example['examples']) > 0) {?>
                            <?php foreach ($example['examples'] as $apiname => $url) { ?>
                            <li><a href="<?= $url ?>"><?= $apiname ?></a></li>
                            <?php } ?>
                        <?php } else { ?>
                            <li class="disabled"><a href="#">建置中</a></li>
                        <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                </ul>
            </li>
                <?php if ($item_count < count($examples_list)) { ?>
            <li role="presentation" class="divider"></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
