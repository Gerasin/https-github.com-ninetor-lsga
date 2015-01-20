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
        <form class="reservation full-width" action="/dyno-reservation/finish" method="POST">
            <div class="reserv-confirm clearfix">
                <p class="reserv-confirm_title acenter">Подтвердите введенные данные</p>
                <hr>
                <div class="reserv-confirm_block two-blocks clearfix">
                    <div>
                        <p>
                            <label>Имя и фамилия:</label>
                            <span><?= $reservation['name']?></span>
                        </p>
                        <p>
                            <label>Эл. почта:</label>
                            <span><?= $reservation['email']?></span>
                        </p>
                        <p>
                            <label>Номер вашего телефона:</label>
                            <span><?= $reservation['phone']?></span>
                        </p>
                    </div><!--
                    --><div>
                        <p>
                            <label>Марка авто:</label>
                            <span><?= $auto_brands['name']?></span>
                        </p>
                        <p>
                            <label>Модель:</label>
                            <span><?= $auto_models['name']?></span>
                        </p>
                        <p>
                            <label>Объем двигателя:</label>
                            <span><?= $reservation['displacement']?></span>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="reserv-confirm_block two-blocks clearfix">
                    <p>
                        <label>Тип работ:</label>
                        <span><?= $dyno_works['name']?> <em class="separate">|</em> <?= $dyno_works['time']?> ч. <em class="separate">|</em> <?= $dyno_works['count']?> Кс</span>
                    </p>
                </div>
                <hr>
                <div class="reserv-confirm_block two-blocks clearfix">
                    <p>
                        <label>Время проведения работ:</label>
                        <span><?= date("H:i", $reservation['start'])?> до <?= date("H:i", $reservation['finish'])?>, <?= Yii::app()->dateFormatter->formatDayInWeek("cccc", $reservation['finish'])?> <?= Yii::app()->dateFormatter->format('d MMMM yyyy', $reservation['finish'])?></span>
                    </p>
                </div>
                <hr>
            </div>

            <div class="reserv-selection acenter">
                <button id='finish-step' class="btn-simple confirmed-reserv popup-open" data-key="reservation-success" onclick='reservationFinishStatus();'><span>подтвердить резервацию</span></button>
            </div>

        </form>
    </div>
    <div class="mask_popup" style="display: none;"></div>
    <div class="popup" id="reservation-success" style="opacity: 0; display: none; margin-top: -148.5px;">
        <article>
            <a class="close"></a>
            <p class="popup-title">Спасибо</p>
            <p class="acenter">Мы выслали на вашу эл. почту информацию по резервации</p>
            <p class="acenter shopping-success_articul">Перейти на <a href='/'>главную</a></p>
        </article>
    </div>
