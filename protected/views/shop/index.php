

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
<ul class="breadcrumbs-bl" style="top: 20px;">
    <li>
        <a class="breadcrumbs-link" href="/">Главная</a>
    </li>
    <li>→</li>
    <li>
       Магазин
    </li>
</ul>
<aside class="sidebar-main shop-filtr">
    <form>
        <fieldset>
            <input type="checkbox" value="" id="che-01">
            <label for="che-01" class="bigest">Авто, мото</label>
        </fieldset>
        <fieldset class="js-accordeon">
            <input type="checkbox" value="" id="che-02">
            <label for="che-02" class="only-checkbox"></label>
            <span class="js-accordeon_head">Автомобили</span>
            <ul class="js-accordeon_body">
                <li><input type="checkbox" value="" id="che-03"><label for="che-03" class="">Легковые</label></li>
                <li><input type="checkbox" value="" id="che-04"><label for="che-04" class="">Грузовые</label></li>
            </ul>
        </fieldset>
        <fieldset class="js-accordeon">
            <input type="checkbox" value="" id="che-05">
            <label for="che-05" class="only-checkbox"></label>
            <span class="js-accordeon_head">Автоуслуги</span>
            <ul class="js-accordeon_body">
                <li><input type="checkbox" value="" id="che-06"><label for="che-06" class="">Аренда авто</label></li>
                <li><input type="checkbox" value="" id="che-07"><label for="che-07" class="">Ремонт авто</label></li>
            </ul>
        </fieldset>
        <fieldset class="js-accordeon">
            <input type="checkbox" value="" id="che-08">
            <label for="che-08" class="only-checkbox"></label>
            <span class="js-accordeon_head">Автохимия</span>
            <ul class="js-accordeon_body">
                <li><input type="checkbox" value="" id="che-09"><label for="che-09" class="">Очистители</label></li>
                <li><input type="checkbox" value="" id="che-10"><label for="che-10" class="">Присадки</label></li>
            </ul>
        </fieldset>
        <fieldset>
            <input type="checkbox" value="" id="che-11">
            <label for="che-11" class="">Автошколы</label>
        </fieldset>
        <fieldset class="js-accordeon">
            <input type="checkbox" value="" id="che-12">
            <label for="che-12" class="only-checkbox"></label>
            <span class="js-accordeon_head">Аксессуары, тюнинг</span>
            <ul class="js-accordeon_body">
                <li><input type="checkbox" value="" id="che-13"><label for="che-13" class="">Хром</label></li>
                <li><input type="checkbox" value="" id="che-14"><label for="che-14" class="">Ручная работа</label></li>
            </ul>
        </fieldset>
        <fieldset>
            <input type="checkbox" value="" id="che-15">
            <label for="che-15" class="">Гаражи</label>
        </fieldset>
        <fieldset class="js-accordeon">
            <input type="checkbox" value="" id="che-16">
            <label for="che-16" class="only-checkbox"></label>
            <span class="js-accordeon_head">Запчасти</span>
            <ul class="js-accordeon_body">
                <li><input type="checkbox" value="" id="che-17"><label for="che-17" class="">Новые</label></li>
                <li><input type="checkbox" value="" id="che-18"><label for="che-18" class="">Б/у</label></li>
            </ul>
        </fieldset>
        <fieldset class="js-accordeon">
            <input type="checkbox" value="" id="che-19">
            <label for="che-19" class="only-checkbox"></label>
            <span class="js-accordeon_head">Мототехника</span>
            <ul class="js-accordeon_body">
                <li><input type="checkbox" value="" id="che-20"><label for="che-20" class="">По воде</label></li>
                <li><input type="checkbox" value="" id="che-21"><label for="che-21" class="">По суше</label></li>
            </ul>
        </fieldset>
        <fieldset>
            <input type="checkbox" value="" id="che-22">
            <label for="che-22" class="">Охранные системы</label>
        </fieldset>
        <fieldset>
            <input type="checkbox" value="" id="che-23">
            <label for="che-23" class="">Шины и диски</label>
        </fieldset>
        <fieldset>
            <input type="checkbox" value="" id="che-24">
            <label for="che-24" class="">Просто длинное название но обрезанное</label>
        </fieldset>
        <fieldset>
            <input type="checkbox" value="" id="che-25">
            <label for="che-25" class="many-row">Просто длинное название, но строк уже неограниченно</label>
        </fieldset>
        <div class="filter-btn-con">
            <a class="filter-btn" href="#"><span>Подобрать</span></a>
        </div>
    </form>


</aside> <!-- sidebar main -->

<div class="content-main">
    <div class="shop">

        <?php

        foreach ($goods as $one_goods) {
            $image = ($one_goods->picture) ? '/upload/images/tovars/'.$one_goods->picture : "/images/tovars/no-photo.png";
            $active = (in_array($one_goods->id, $cart));
            $html = "";
             if ($active)
             {
                 $html.= '<div class="tovar active">';
             }
                 else
                 {
                     $html.= '<div class="tovar">';
                 }

            $html.= '<a href="/shop/goods/'.$one_goods->id.'" class="tovar-photo"><span class="tovar-photo_wrapper"><img src='.$image.' alt=""></span></a>
            <a href="/shop/goods/'.$one_goods->id.'" class="tovar-name">'.$one_goods->name.'</a>
            <p class="tovar-cost aright"><strong>'.$one_goods->price.'</strong> &#8364;</p>
            <p class="aright tovar_action"><button class="favorite js-toggle-active pull-left"></button>';
            if ($active)
            {
                $html.= ' <button class="lock-link hidden" onclick="addToCart(this,'.$one_goods->id.',1)">Добавить в корзину</button>
                <span class="">В корзине.</span><a href="/shop/cart" class="underline">Оформить</a>';
            }
            else
            {
                $html.= ' <button class="lock-link" onclick="addToCartIndex(this,'.$one_goods->id.',1)">Добавить в корзину</button>
                <span class="hidden">В корзине.</span><a href="/shop/cart" class="hidden underline">Оформить</a>';
            };
            $html.= '</p></div>';
            echo $html;
        }
?>
    </div>

    <?php $this->widget('CLinkPager', array(
        'pages' => $pages,
        'header' => '',
        'prevPageLabel'=>'Назад',
        'nextPageLabel'=>'Вперед',
        'cssFile' => '/css/pager.css',
    ))?>

</div>

</div> <!-- end content -->

</div>