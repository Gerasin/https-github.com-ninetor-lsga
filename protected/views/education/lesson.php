<?php
$this->pageTitle = $lesson->name;
?>
<ul class="breadcrumbs-bl">
    <li>
        <a class="breadcrumbs-link" href="/">Главная</a>
    </li>
    <li>&rarr;</li>
    <li>
        <a class="breadcrumbs-link" href="/education">Школа</a>
    </li>
    <li>&rarr;</li>
    <li>
        <?= $lesson->name?>
    </li>
</ul>
<aside class="sidebar-main be-fixed">
    <ul class="klass-partitons fix-nicescroll">
        <?php foreach ($list as $value): ?>
            <li>
                <a href="/education/lesson/<?= $cid?>/<?= $value->id?>" <?php if ($value->id == $lesson->id): ?>class="active"<?php endif; ?>><?= $value->name?></a>
            </li>
        <?php endforeach; ?>        
    </ul>
    <?php if ($problem > 0): ?>
        <div class="filter-btn-con">
            <a class="filter-btn" href="/education/exam/<?= $cid?>"><span>Экзамен</span></a>
        </div>
    <?php endif; ?>
    <div class="short-info_user">
        <strong><?= Yii::app()->user->getUserObj()->id; ?></strong>
    </div>
</aside> <!-- sidebar main -->
<div class="content-main">
    <div class="school">
        <?= $lesson->description?>
    </div> <!-- end list-services -->
</div>
