
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

            <form class="basket" method="post" action="cart_step_two" onsubmit="return CheckFieldsStepOne()">

                <div class="basket_steps">
                    <span class="active">Адрес доставки</span><!--
                    --><em></em><!--
                    --><span>Выбор способа доставки</span><!--
                    --><em></em><!--
                    --><span>Выбор способа оплаты</span><!--
                    --><em></em><!--
                    --><span>Подтверждение</span>
                </div>

                <div class="basket_address">
                    <fieldset>
                        <label class="input-name">Страна</label>
                        <div class="select-wrapper">
                            <select name="country" style="display: none;">
                                <option>Россия</option>
                                <option>Беларусь</option>
                                <option>Казахстан</option>
                                <option>Украина</option>
                                <option>Польша</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset>
                        <label class="input-name">Город</label>
                        <input type="text" name="city" id="city-register" value="" placeholder="">
                    </fieldset>
                    <fieldset>
                        <label class="input-name">Телефон (с кодом страны)</label>
                        <input type="text" name="telephone" id="phone-register" value="" placeholder="">
                    </fieldset>
                    <fieldset>
                        <label class="input-name">Улица, номер дома, квартира</label>
                        <input type="text" name="street" value="" placeholder="Улица">
                        <div class="more-inputs clearfix">
                            <input type="text" value="" name="home" class="pull-left" placeholder="Номер дома">
                            <input type="text" value="" name="apartment" class="pull-left" placeholder="Квартира">
                        </div>
                    </fieldset>
                </div>

                <div class="basket-end acenter">
                    <button type="submit" class="btn-simple next-step"><span>Перейти к шагу 2</span></button>
                </div>

            </form>

        </div>

    </div> <!-- end content -->

</div>