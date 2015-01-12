<?php
/* @var $this EducationController */

$this->breadcrumbs = array(
    'Education',
);
$this->pageTitle = "Школа";
?>
<div class="header-content-text">
    <?= $education_block ?>               
</div>
</div> <!-- end header content -->
</div>
</header>
<div class="wrapper">
    <div class="content">
<ul class="breadcrumbs-bl">
    <li>
        <a class="breadcrumbs-link" href="/">Главная</a>
    </li>
    <li>&rarr;</li>
    <li>
        Школа
    </li>
</ul>

<div class="school school-category">
    <?php
    $count_education = 1;
    foreach ($education as $value):
        ?>
        <div class="category-block <?php if ($value->active == 1): ?>active<?php endif; ?>" <?php if ($value->active == 1): ?>onclick="document.location.href = '/education/category/<?= $value->id ?>'"<?php endif; ?>>
            <div class="category-block_body">
                <img src="/upload/images/education/<?= $value->img ?>" alt="<?= $value->name ?>" />
                <p class="category-block_title"><?= $value->name ?></p>
                <p class="category-block_num"><?= $count_education ?></p>
                <p class="category-block_description"><?php mb_internal_encoding("UTF-8"); ?><?= mb_substr($value->description, 0, 230) ?></p>
            </div>
            <?php if ($value->active == 1): ?>
                <a href="/education/category/<?= $value->id ?>" class="button"><span>Начать занятия</span></a>
            <?php else: ?>
                <span class="pseudo-button dark-blue"><span>Временно недоступно</span></span>
            <?php endif; ?>
        </div><!--
        -->
        <?php
        $count_education++;
    endforeach;
    ?>        
</div> 