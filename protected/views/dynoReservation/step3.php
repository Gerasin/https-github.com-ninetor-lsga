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
        <pre>    
<?= var_dump($reservation)?>
        </pre> 
        <form class="reservation full-width" action="/dyno-reservation/finish" method="POST">
            <button class="btn-simple next-step" id='next-step' ><span>ДАЛЕЕ</span></button>
        </form>
    </div>
