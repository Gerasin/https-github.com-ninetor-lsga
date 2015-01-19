
<div class="header-inner">
    <div class="header-content">
        <h1 class="header-content-title">
            Оформление заказа
        </h1>
    </div> <!-- end header content -->
</div>
</header>
<div class="wrapper">
    <div class="">
        <div class="content-main">

            <form class="basket">

                <div class="basket_steps">
                    <span>Адрес доставки</span><!--
                    --><em></em><!--
                    --><span>Выбор способа доставки</span><!--
                    --><em></em><!--
                    --><span>Выбор способа оплаты</span><!--
                    --><em></em><!--
                    --><span class="active">Подтверждение</span>
                </div>

                <table class="only-read">
                    <thead>
                    <tr>
                        <th class="aleft">Фото</th>
                        <th class="aleft">Название, код товара</th>
                        <th>Статус</th>
                        <th>Стоимость</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($cart as $goods) {
                        $pic = ($goods->shopGoods->picture) ? '/upload/images/tovars/'.$goods->shopGoods->picture : "/images/tovars/no-photopng";
                        if ($goods->shopGoods->discount>0)
                            $price = $goods->shopGoods->price-(($goods->shopGoods->price*$goods->shopGoods->discount)/100);
                        else
                            $price = $goods->shopGoods->price;

                        echo '<tr id="'.$goods->id.'">
                        <td class="aleft"><a href="/shop/goods/'.$goods->shopGoods->id.'"><img src="'.$pic.'" alt=""></a></td>
                        <td class="aleft">
                            <p><a href="/shop/goods/'.$goods->shopGoods->id.'">'.$goods->shopGoods->name.'</a></p>
                            <p><em>Код: '.$goods->shopGoods->code.'</em></p>
                        </td>
                        <td>';
                        if ($goods->shopGoods->warehouse_count==0) echo $goods->shopGoods->empty_warehouse_message; else echo 'На складе';
                        echo '</td><td><span class="tovar_cost"><strong>'.$price*$goods->count .'</strong> &#8364; </span></td>';
                    }
                    ?>

                    <tr>
                        <th colspan="4" class="aright summary-cost">
                            <em>Общая сумма <?= ((Yii::app()->session['cart_discount']>0) ? "(с учетом скидки ".Yii::app()->session['cart_discount']."%)" : "")?></em><strong><?=Yii::app()->session['cart_price']?></strong>  &#8364;
                        </th>
                    </tr>
                    </tbody>
                </table>

                <div class="two-table">
                    <div>
                        <table class="basket_address_info">
                            <thead>
                            <tr>
                                <th colspan="2">Адрес доставки</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th><span>Страна</span></th>
                                <td><?=Yii::app()->session['cart_country']?></td>
                            </tr>
                            <tr>
                                <th><span>Город</span></th>
                                <td><?=Yii::app()->session['cart_city']?></td>
                            </tr>
                            <tr>
                                <th><span>Телефон (с кодом страны)</span></th>
                                <td><?=Yii::app()->session['cart_telephone']?></td>
                            </tr>
                            <tr>
                                <th><span>Улица, номер дома, квартира</span></th>
                                <td><?=Yii::app()->session['cart_street'].', '.Yii::app()->session['cart_home'].', '.Yii::app()->session['cart_apartment']?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!--
                    --><div>
                        <table class="basket_pay_info">
                            <thead>
                            <tr>
                                <th>Способ оплаты</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?=Yii::app()->session['cart_type_payment']?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="basket-end">
                    <button class="btn-simple tovar_buy pull-right popup-open" data-key="shopping-success"><span>Оплатить</span></button>
                    <div class="summary-cost">
                        <em>Итоговая сумма (с учетом доставки)</em><strong><?=Yii::app()->session['cart_total_price']?></strong>  &#8364;
                    </div>
                </div>

            </form>

        </div>

    </div> <!-- end content -->

    <div class="mask_popup"></div>
    <div class="popup" id="shopping-success">
        <article>
            <a class="close"></a>
            <p class="popup-title">Спасибо за заказ</p>
            <p class="acenter">Мы выслали на вашу эл. почту информацию по этому заказу</p>
            <p class="acenter shopping-success_articul">Номер заказа: <em>A2G034FGN-DS</em></p>
        </article>
    </div>
</div>