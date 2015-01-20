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
        <form class="reservation full-width" action="/dyno-reservation/step-3" method="POST">
            <div class="reserv-navigate clearfix">
                <a href="#" class="pull-left" style="display: none">Предыдущая неделя</a>
                <a href="#" class="pull-right" style="display: none">Следующая неделя</a>
                Выберите дату  из доступных
            </div>
            <table class="reserv-table">
                <thead>
                    <tr>
                        <?php foreach ($dayWeek as $value): ?>
                            <th><?= Yii::app()->dateFormatter->formatDayInWeek('cccc', $value); ?> <?= date('(d.m)', $value)?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($timetable as $value): ?>                   
                        <tr>
                            <?php foreach ($value as $item): ?>                                 
                                <td>
                                    <?php if ($item['startTimeWork']): ?>
                                        <div class="timevariant time-variant" data-start="<?= $item['startTimeWork']?>" data-finish="<?= $item['finishTimeWork']?>"><?= date("H:i", $item['startTimeWork'])?> — <?= date("H:i", $item['finishTimeWork'])?></div>
                                    <?php else: ?>
                                        Недоступно
                                    <?php endif; ?>
                                </td>                                                             
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" value="1" name="finish"/>
            <div class="reserv-selection aright">
                <button class="btn-simple next-step" onclick="history.back();
                        return false;" style="margin-right: 40px;"><span>НАЗАД</span></button>
                <span id='textForUserStatus'>Выберите время  из доступных вариантов</span>
                <button class="btn-simple next-step" id='next-step' disabled><span>ДАЛЕЕ</span></button>
            </div>
        </form>
    </div>   

