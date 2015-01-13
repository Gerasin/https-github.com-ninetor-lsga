
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
            <div class="tovar_details js-tabs clearfix">
                <div class="js-tabs_head">
                    <span data-tab="tab-1">Описание</span>
                    <span data-tab="tab-2">Доставка</span>
                    <span data-tab="tab-3" class="active">Гарантии</span>
                    <span data-tab="tab-4">Продавец</span>
                    <span data-tab="tab-5">Похожие товары</span>
                </div>
                <div class="js-tabs_body" data-tab="tab-1">
                    <h2>ВЫПУСКНОЙ КОЛЛЕКТОР BMW M3 E46 01 02 03 04 05 3.2L ВЫПУСКА HEADER 01-05 BMW E46 M3</h2>
                    <p>
                        Original Megan Racing Product. Part #MR-ABE-BE46M30E-VO<br>
                        T-304 Stainless Steel Construction<br>
                        Quad 3" burnt roll tips design<br>
                        Direct, bolt-on installation.<br>
                        No gaskets or hardware (bolts) included-- ABE connection uses a sliding flange on a flared pipe that accepts the original piping. The original bolts are reused. 4x M8x1.25x42mm nuts and bolts included for hangers.<br>
                        Polished Tip Design<br>
                    </p>
                </div>
                <div class="js-tabs_body" data-tab="tab-2">
                    <h2>ВЫПУСКНОЙ КОЛЛЕКТОР BMW M3 E46 01 02 03 04 05 3.2L ВЫПУСКА HEADER 01-05 BMW E46 M3</h2>
                    <p>
                        You Receive in this Auction:One Axle Exhaust<br>
                        Item is 100% New, Never used or installed.<br>
                        Original Megan Racing Product. Part #MR-ABE-BE46M30E-VO<br>
                        T-304 Stainless Steel Construction<br>
                        2.5" diameter piping<br>
                        1 Year Limited Warranty through Megan Racing.<br>
                        Constructed of T-304 Stainless Steel and polished to a mirror finish, this Axle-Back system offers free-flowing performance over your OEM restrictive exhaust system. Being constructed of Stainless-Steel, this exhaust piece is much more lighter than your OEM system and offers increased Power:Weight ratio that plays an important role in your cars handling and performance.<br>
                        Product does not come with installation instructions, please refer to a shop/factory manual for installation.
                    </p>
                </div>
                <div class="js-tabs_body active" data-tab="tab-3">
                    <h2>ВЫПУСКНОЙ КОЛЛЕКТОР BMW M3 E46 01 02 03 04 05 3.2L ВЫПУСКА HEADER 01-05 BMW E46 M3</h2>
                    <p>
                        You Receive in this Auction:One Axle Exhaust<br>
                        Item is 100% New, Never used or installed.<br>
                        Original Megan Racing Product. Part #MR-ABE-BE46M30E-VO<br>
                        T-304 Stainless Steel Construction<br>
                        Quad 3" burnt roll tips design<br>
                        Direct, bolt-on installation.<br>
                        No gaskets or hardware (bolts) included-- ABE connection uses a sliding flange on a flared pipe that accepts the original piping. The original bolts are reused. 4x M8x1.25x42mm nuts and bolts included for hangers.<br>
                        Polished Tip Design<br>
                        2.5" diameter piping<br>
                        1 Year Limited Warranty through Megan Racing.<br>
                        Constructed of T-304 Stainless Steel and polished to a mirror finish, this Axle-Back system offers free-flowing performance over your OEM restrictive exhaust system. Being constructed of Stainless-Steel, this exhaust piece is much more lighter than your OEM system and offers increased Power:Weight ratio that plays an important role in your cars handling and performance.<br>
                        Product does not come with installation instructions, please refer to a shop/factory manual for installation.
                    </p>
                </div>
                <div class="js-tabs_body" data-tab="tab-4">
                    <h2>ТЕСТ</h2>
                    <p>
                        Тут очень мало текста
                    </p>
                </div>
                <div class="js-tabs_body" data-tab="tab-5">
                    <h2>ТЕСТ 2</h2>
                    <p>А тут очень много текста</p>
                    <p>
                        You Receive in this Auction:One Axle Exhaust<br>
                        Item is 100% New, Never used or installed.<br>
                        Original Megan Racing Product. Part #MR-ABE-BE46M30E-VO<br>
                        T-304 Stainless Steel Construction<br>
                        Quad 3" burnt roll tips design<br>
                        Direct, bolt-on installation.<br>
                        No gaskets or hardware (bolts) included-- ABE connection uses a sliding flange on a flared pipe that accepts the original piping. The original bolts are reused. 4x M8x1.25x42mm nuts and bolts included for hangers.<br>
                        Polished Tip Design<br>
                        2.5" diameter piping<br>
                        1 Year Limited Warranty through Megan Racing.<br>
                        Constructed of T-304 Stainless Steel and polished to a mirror finish, this Axle-Back system offers free-flowing performance over your OEM restrictive exhaust system. Being constructed of Stainless-Steel, this exhaust piece is much more lighter than your OEM system and offers increased Power:Weight ratio that plays an important role in your cars handling and performance.<br>
                        Product does not come with installation instructions, please refer to a shop/factory manual for installation.
                    </p>
                    <p>
                        You Receive in this Auction:One Axle Exhaust<br>
                        Item is 100% New, Never used or installed.<br>
                        Original Megan Racing Product. Part #MR-ABE-BE46M30E-VO<br>
                        T-304 Stainless Steel Construction<br>
                        Quad 3" burnt roll tips design<br>
                        Direct, bolt-on installation.<br>
                        No gaskets or hardware (bolts) included-- ABE connection uses a sliding flange on a flared pipe that accepts the original piping. The original bolts are reused. 4x M8x1.25x42mm nuts and bolts included for hangers.<br>
                        Polished Tip Design<br>
                        2.5" diameter piping<br>
                        1 Year Limited Warranty through Megan Racing.<br>
                        Constructed of T-304 Stainless Steel and polished to a mirror finish, this Axle-Back system offers free-flowing performance over your OEM restrictive exhaust system. Being constructed of Stainless-Steel, this exhaust piece is much more lighter than your OEM system and offers increased Power:Weight ratio that plays an important role in your cars handling and performance.<br>
                        Product does not come with installation instructions, please refer to a shop/factory manual for installation.
                    </p>
                    <p>
                        You Receive in this Auction:One Axle Exhaust<br>
                        Item is 100% New, Never used or installed.<br>
                        Original Megan Racing Product. Part #MR-ABE-BE46M30E-VO<br>
                        T-304 Stainless Steel Construction<br>
                        Quad 3" burnt roll tips design<br>
                        Direct, bolt-on installation.<br>
                        No gaskets or hardware (bolts) included-- ABE connection uses a sliding flange on a flared pipe that accepts the original piping. The original bolts are reused. 4x M8x1.25x42mm nuts and bolts included for hangers.<br>
                        Polished Tip Design<br>
                        2.5" diameter piping<br>
                        1 Year Limited Warranty through Megan Racing.<br>
                        Constructed of T-304 Stainless Steel and polished to a mirror finish, this Axle-Back system offers free-flowing performance over your OEM restrictive exhaust system. Being constructed of Stainless-Steel, this exhaust piece is much more lighter than your OEM system and offers increased Power:Weight ratio that plays an important role in your cars handling and performance.<br>
                        Product does not come with installation instructions, please refer to a shop/factory manual for installation.
                    </p>
                </div>
            </div>

        </div>

    </div> <!-- end content -->

    <footer>
        <ul class="footer-menu">
            <li><a class="footer-menu-link" href="#">О нас</a></li>
            <li><a class="footer-menu-link" href="#">Контакты</a></li>
            <li><a class="footer-menu-link" href="#">Правила сайта</a></li>
            <li><a class="footer-menu-link" href="#">Карта сайта</a></li>
            <li><a class="footer-menu-link" href="#">Дилеры</a></li>
        </ul> <!--end footer-menu -->

        <div class="footer-copyright">
            © 2014 «LSGA»
            Сделали в <a href="#">Nineseven</a>
        </div>

    </footer>
</div>