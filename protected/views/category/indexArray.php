<aside class="sidebar-main">
    <h2 class="sidebar-title">
        <a href="#" class="sidebar-title-link"><?= $category->name ?></a>
    </h2>
    <ul class="catalog-main" id="filterpages" data-check-list>
        <form action="/category/<?= $category->id ?>" id="formFilter" method="get">
        <?php $propertiesCount=0; foreach ($properties as $value): ?>
            <li>
                <label class="catalog-main-check">
                    <input type="checkbox" name="res[<?= $propertiesCount ?>]" class="catalog-main-check-inner" value="<?= $value['id'] ?>"/>
                </label>
                <a class="catalog-main-link" href="#">
                    <span><?= $value['text'] ?></span>
                </a>
                <?php if ($value['children']): ?>
                    <ul>
                        <?php foreach ($value['children'] as $item): $propertiesCount++;?>
                            <li>
                                <label class="catalog-main-check">
                                    <input type="checkbox" name="res[<?= $propertiesCount ?>]" class="catalog-main-check-inner" value="<?= $item['id'] ?>"/>
                                </label>
                                <a class="catalog-main-link" href="#">
                                    <span><?= $item['text'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>                       
                    </ul>
                 <?php else: $propertiesCount++;?>
                <?php endif; ?>
            </li>
        <?php  endforeach; ?> 
        </form>
    </ul>
    <div class="filter-btn-con">
        <a class="filter-btn" href="#" onclick="filterPages(<?= $category->id ?>); return false;"><span>Подобрать</span></a>
    </div>
</aside> <!-- sidebar main -->

<div class="content-main">
    <div class="list-services">
        <?php foreach ($pages as $key ): ?>    
        <?php foreach ($key as $a=>$value): ?>    
        <?var_dump($value)?>
            <div class="service-item">
                <a class="service-item-img" href="/category/page/<?php echo $value->id ?>"  <?php if (!empty($value['img'])): ?>
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
             <?php endforeach; ?>    
    </div> <!-- end list-services -->
</div>
<script src="/js/pages.js"></script>