
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
            <form class="basket" method="post" action="cart_step_four" >

                <div class="basket_steps">
                    <span>Адрес доставки</span><!--
                    --><em></em><!--
                    --><span>Выбор способа доставки</span><!--
                    --><em></em><!--
                    --><span class="active">Выбор способа оплаты</span><!--
                    --><em></em><!--
                    --><span>Подтверждение</span>
                </div>

                <div class="basket_pay">
                    <p>Выберите способ, которым хотите оплатить товар</p>
                    <fieldset>
                        <input type="radio" name="type_payment" checked value="PayPal" id="pay-1"><label for="pay-1">PayPal</label>
                    </fieldset>
                    <fieldset>
                        <input type="radio" name="type_payment" value="Visa" id="pay-2"><label for="pay-2">Visa</label>
                    </fieldset>
                    <fieldset>
                        <input type="radio" name="type_payment" value="MasterCard" id="pay-3"><label for="pay-3">MasterCard</label>
                    </fieldset>
                </div>

                <div class="basket-end acenter">
                    <button type="submit" class="btn-simple next-step"><span>Перейти к шагу 4</span></button>
<!--                    <p class="no-credits">У вас недостаточно кредитов для оплаты товара</p>-->
<!--                    <p><a href="#" class="popup-open" data-key="replenishment-credit">Пополнить</a></p>-->
                </div>

            </form>


        </div>

    </div> <!-- end content -->

</div>