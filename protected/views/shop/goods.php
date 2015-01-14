
<div class="header-inner">
    <div class="header-content">
        <h1 class="header-content-title">
Магазин
        </h1>
    </div> <!-- end header content -->
</div>
</header>
<div class="wrapper">
    <div class="">
        <ul class="breadcrumbs-bl" style="top: 82px;">
            <li>
                <a class="breadcrumbs-link" href="/">Главная</a>
            </li>
            <li>→</li>
            <li>
                <a class="breadcrumbs-link" href="/shop">Магазин</a>
            </li>
            <li>→</li>
            <li>
                <?=$goods->name?>
            </li>
        </ul>


        <div class="content-main">
            <div class="tovar_summary">
                <div class="tovar_summary_photo">
                    <div class="tovar_summary_photo_wrapper">
                        <img src="<?=($goods->picture) ? '/upload/images/tovars/'.$goods->picture : "/images/tovars/no-photo"?>" alt="">
                    </div>
                </div>
                <div class="tovar_description">
                    <p class="tovar_description_title"> <?=$goods->name?></p>
                    <p class="tovar_description_article">Код продукта: <?=$goods->code?></p>
                    <p class="tovar_description_delay">Отправка через 10-20 дней после заказа</p>
                    <div class="tovar_description_action">
                        <div class="clearfix">
                            <form class="tovar_action_count pull-right">
                                <em class="pull-left">Количество:</em>
                                <button class="minus disabled"></button><input type="text" value="1"><button class="plus"></button>
                            </form>
                            <span class="tovar_action_cost"><strong><?=$goods->price?></strong> руб.</span>
                        </div>
                        <div class="clearfix">
                            <button class="btn-simple pull-right tovar_action_buy"><span>Добавить в корзину</span></button>
                            <button class="js-toggle-active tovar_action_favorite"><span>Добавить в список желаний</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (count($goods->shopGoodsProperties)>0){?>
            <div class="tovar_details js-tabs clearfix">


                <div class="js-tabs_head">
                    <?php $i=1; foreach ($goods->shopGoodsProperties as $property) {
                        if ($i==1)
                        echo '<span data-tab="tab-'.$i.'" class="active">'.$property->title.'</span>';
                        else
                        echo '<span data-tab="tab-'.$i.'">'.$property->title.'</span>';
                        $i++;
                    }
                    ?>
                </div>
                <?php $i=1;  foreach ($goods->shopGoodsProperties as $property) {
                    if ($i==1)
                        echo '<div class="js-tabs_body active" data-tab="tab-'.$i.'" ><p>'.$property->text.'</p></div>';
                    else
                    echo '<div class="js-tabs_body" data-tab="tab-'.$i.'"><p>'.$property->text.'</p></div>';
                    $i++;
                }
                ?>
            </div>
            <?php }?>
        </div>
    </div> <!-- end content -->

</div>





