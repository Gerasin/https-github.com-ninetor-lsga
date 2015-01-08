<?php
$this->pageTitle = $category->name;
?>
<div class="header-content-text">
    <?= $category->description ?>               
</div>
</div> <!-- end header content -->
</div>

</header>

<div class="wrapper">
    <div class="content">
        <aside class="sidebar-main">
            <?php if($properties):?>
            <h2 class="sidebar-title">
                <a href="#" class="sidebar-title-link"><?= $category->name ?></a>       
            </h2>
            <ul class="catalog-main" id="filterpages" data-check-list>
                <form action="/category/<?= $category->id ?>" id="formFilter" method="get">
                    <?php
                    $propertiesCount = 0;
                    foreach ($properties as $value):
                        ?>
                        <li>
                            <label class="catalog-main-check">
                                <input <?php if (in_array($value['id'], $res)): ?>checked="checked"<?php endif; ?> type="checkbox" name="res[<?= $propertiesCount ?>]" class="catalog-main-check-inner" value="<?= $value['id'] ?>"/>
                            </label>
                            <a class="catalog-main-link" href="#">
                                <span><?= $value['text'] ?></span>
                            </a>
                                <?php if ($value['children']): ?>
                                <ul>
        <?php foreach ($value['children'] as $item): $propertiesCount++; ?>
                                        <li>
                                            <label class="catalog-main-check">
                                                <input <?php if (in_array($item['id'], $res)): ?>checked="checked"<?php endif; ?> type="checkbox" name="res[<?= $propertiesCount ?>]" class="catalog-main-check-inner" value="<?= $item['id'] ?>"/>
                                            </label>
                                            <a class="catalog-main-link" href="#">
                                                <span><?= $item['text'] ?></span>
                                            </a>
                                        </li>
                                <?php endforeach; ?>                       
                                </ul>
                            <?php else: $propertiesCount++; ?>
                        <?php endif; ?>
                        </li>
<?php endforeach; ?> 
                </form>
            </ul>
            <div class="filter-btn-con">
                <a class="filter-btn" href="#" onclick="return false;
                filterPages(<?= $category->id ?>);
                return false;"><span>Подобрать</span></a>
            </div>
            <?php endif;?>
        </aside> <!-- sidebar main -->

        <div class="content-main">
            <div class="list-services">
                <?php if (count($pages) > 0): ?>
    <?php foreach ($pages as $value): ?>       
                        <div class="service-item">
                            <a class="service-item-img" href="/category/page/<?php echo $value->id ?>"  <?php if (!empty($value->img)): ?>
                                   style="background-image: url(/upload/images/pages/temp/<?php echo $value->img ?>)"                       
        <?php endif; ?>>
                                <span class="service-item-title-con">
                                    <span class="service-item-title">
        <?= $value->name ?>
                                    </span>
                                </span>
                            </a>
                            <div class="service-item-text">
        <?= $value->prev_text ?>
                            </div>
                        </div> <!-- end service-item -->
                    <?php endforeach; ?>     
                <?php else: ?>
                    Нет данных
<?php endif; ?>
            </div> <!-- end list-services -->
        </div>
        <script src="/js/pages.js"></script>