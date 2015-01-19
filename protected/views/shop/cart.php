
<div class="header-inner">
    <div class="header-content">
        <h1 class="header-content-title">
            Корзина
        </h1>
    </div> <!-- end header content -->
</div>
</header>

<div class="wrapper">
    <div class="">
        <div class="content-main">

            <form class="basket" action="cart_step_one" method="post">
                <table>
                    <thead>
                    <tr>
                        <th class="aleft">Фото</th>
                        <th class="aleft">Название, код товара</th>
                        <th>Статус</th>
                        <th>Количество</th>
                        <th>Стоимость</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $allprice = 0;
                    foreach ($cart as $goods) {
                        $pic = ($goods->shopGoods->picture) ? '/upload/images/tovars/'.$goods->shopGoods->picture : "/images/tovars/no-photo";
                  if ($goods->shopGoods->discount>0)
                       $price = $goods->shopGoods->price-(($goods->shopGoods->price*$goods->shopGoods->discount)/100);
                    else
                        $price = $goods->shopGoods->price;
                        $allprice+= $price*$goods->count ;
                        echo ' <tr id="'.$goods->id.'">
                        <td class="aleft"><a href="/shop/goods/'.$goods->shopGoods->id.'"><img src="'.$pic.'" alt=""></a></td>
                        <td class="aleft">
                            <p><a href="/shop/goods/'.$goods->shopGoods->id.'">'.$goods->shopGoods->name.'</a></p>
                            <p><em>Код: '.$goods->shopGoods->code.'</em></p>
                        </td>
                        <td>';
                        if ($goods->shopGoods->warehouse_count==0) echo $goods->shopGoods->empty_warehouse_message; else echo 'На складе';
                        echo '</td><td>
                            <div class="tovar_action_count">
                                <button class="minus disabled"></button><input type="text" class="count_cart_goods" onchange="changeValCountCart(this)" value="'.$goods->count.'"><button class="plus"></button>
                            </div>
                        </td>
                        <td><span class="tovar_cost"><input type="hidden" value="'.$price.'" /><strong>'.$price*$goods->count .'</strong> &#8364; </span></td>
                        <td><input type="button" class="remove-from-basket" onclick="RemoveFromBasket(this)"/></td>
                    </tr>';
                    }
                    ?>
                    <tr>
                        <th colspan="6" class="aright summary-cost">
                            <em>Общая сумма</em><strong><?=$allprice?></strong>  &#8364;
                        </th>
                    </tr>
                    </tbody>
                </table>

                <div class="sale">
                    <div class="sale_title">Получить скидку за кредиты</div>
                    <div class="sale_body">
                        <div>
                            <div class="sale_input pull-right">
                                <?php if ($goods->user->credit>0):?>
                                За какое количество вы хотите получить скидку?
                                <input type="text" value="0" name="credits">
                                <input type="button" class="sale_input_button" onclick="CalculateDiscount()" value="Расчитать скидку">
                                    <?php else: ?>
                                    <a href="/settings" class="sale_input_button" id="add_credits_href" >Пополнить кол-во кредитов</a>
                                <?php endif;?>
                            </div>
                            У вас на счету
                            <span class="sale_credits"><?=$goods->user->credit?><i class="credit-ico"></i></span>
                            <hr class="vertical">
                        </div>
                        <hr>
                        <div>
                            <div class="summary-cost pull-right">
                                <em>Конечная цена товара со скидкой</em><strong><?=$allprice?></strong> &#8364;
                                <input id="summary-cost_hidden" name="price" type="hidden" value="<?=$allprice?>">
                            </div>
                            Скидка на товар в вашей корзине составит <strong class="summary-sale"><span>0</span>%</strong>
                            <input id="summary-sale_hidden" name="discount" type="hidden" value="0">
                        </div>
                    </div>
                </div>

                <div class="basket-end aright">
                    <a href="/shop">Продолжить покупки</a>
                    <button type="submit" class="btn-simple tovar_buy"><span>Оформить заказ</span></button>
                </div>

            </form>

        </div>

    </div> <!-- end content -->
</div>