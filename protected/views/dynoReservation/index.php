<?php
/* @var $this DynoReservationController */

$this->breadcrumbs = array(
    'Dyno Reservation',
);
$this->pageTitle = "Резервация диностенда";
?>
<script type="text/javascript" src="/js/reservation.js"></script>
<div class="">
    <div class="content-main">

        <form action="/dyno-reservation/step-2" method="POST" class="reservation" id="reservation_step_1" onsubmit="return dyno_reservation_step1();">
            <div class="two-blocks partition">
                <div>
                    <fieldset>
                        <label class="label">Имя и фамилия</label>
                        <input type="text" value="" name="reservation[name]" />                       
                    </fieldset>
                    <fieldset>
                        <label class="label">Эл. почта</label>
                        <input type="text" value="" name="reservation[email]"/>
                    </fieldset>
                    <fieldset>
                        <label class="label">Номер вашего телефона</label>
                        <input type="text" value="" name="reservation[phone]" placeholder="+7  ( 123 )  123 - 45 - 67"/>
                    </fieldset>
                </div><!--
                --><div>
                    <fieldset>
                        <label class="label">Марка авто</label>
                        <div class="select-wrapper">
                            <?php if (count($auto_brands) > 0): ?>
                                <select name="reservation[auto_brands]" id="auto_brands" onchange="select_auto_models(this.options[this.selectedIndex].value)">
                                    <?php foreach ($auto_brands as $value): ?>
                                        <option value="<?= $value->id?>"><?= $value->name?></option>
                                    <?php endforeach; ?>                                
                                </select>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                    <fieldset>
                        <label class="label">Модель</label>
                        <div class="select-wrapper">
                            <?php if (!is_null($auto_models)): ?>
                                <select name="reservation[auto_models]" id="auto_models">
                                    <?php foreach ($auto_models as $value): ?>
                                        <option value="<?= $value->id?>"><?= $value->name?></option>
                                    <?php endforeach; ?>  
                                </select>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                    <fieldset>
                        <label class="label">Объем двигателя</label>
                        <input type="text" name="reservation[displacement]" value="" />
                    </fieldset>
                </div>                
            </div>
            <?php if (count($dyno_works) > 0): ?>
                <div class="two-blocks partition"><?php foreach ($dyno_works as $value): ?><!--
                        --><div class="reservation_block">
                            <img src="/upload/images/reservation/<?= $value->img?>" alt="" />
                            <input type="radio" name="reservation[reserv]" value="<?= $value->id?>" id="reserv-<?= $value->id?>" />
                            <label for="reserv-<?= $value->id?>">
                                <span class="reservation_block_title"><?= $value->name?></span>
                                <span class="reservation_block_time">Время работы: <?= $value->time?> ч.  </span>
                                <span class="reservation_block_cost"><?= $value->count?></span>
                                <a href="#" class="reservation_block_description">Описание выполняемых работ</a>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="reserv-end acenter">
                <p>
                    <input type="checkbox" value="reserv-rules" id="reserv-rules" onchange="reserv_rules_ok(this.checked)" /><label for="reserv-rules">Я внимательно прочитал и согласен с <a href="#">Условиями Эксплуатации Диностенда</a></label>
                </p>
                <button class="btn-simple next-step" id="next-step" disabled><span>ДАЛЕЕ</span></button>
            </div>
        </form>