<?php
    $this->pageTitle = "Экзамен";
?>
<script type="text/javascript" src="/js/ans.js"></script>
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
        Экзамен
    </li>
</ul>
<aside class="sidebar-main be-fixed">
    <ul class="klass-partitons fix-nicescroll">
        <?php
        $count = 1;
        foreach ($problems as $value) :
            ?>
            <li>
                <a <?php if ($count == 1): ?>class="active"<?php endif; ?> id="value<?= $count ?>">Вопрос <?= $count ?></a>
            </li>
            <?php
            $count++;
        endforeach;
        ?>        
    </ul>
    <div class="short-info_user">
        <strong><?= Yii::app()->user->id ?></strong>
    </div>
</aside> <!-- sidebar main -->

<div class="content-main">
    <div class="school"><?php if ($problem!=FALSE): ?>
            <h2 id="h2_ans"><?= $problem->text ?></h2>
            <hr />
            <h3>Выберите ответ:</h3>
            <form id="form_problem_ans">
                <input type="hidden" name="problem" value="<?= $problem->id ?>"/>
                <input type="hidden" name="class" value="<?= $id_problem ?>"/>
                <input type="hidden" name="position" value="1"/>
                <?php $countAns = 1;
                foreach ($ans as $value):
                    ?>
                    <fieldset>
                        <input type="radio" checked value="<?= $value->id ?>" id="radio-<?= $countAns ?>" name="ans" />
                        <label for="radio-<?= $countAns ?>"><?= $value->text ?></label>
                    </fieldset>
                    <?php $countAns++;
                endforeach;
                ?>            
            </form>
            <p id="comment_ans"><?= $problem->comment ?></p>
            <p class="next-question">
                <img class="ans_loader" src="/images/ajax_loader.gif" /><a href="#" onclick="problem_ans_form();
                        return false;" id="nextButton">Следующий вопрос &rarr;</a>
            </p>
        <?php else: ?>
            Вы не можете пройти этот тест
<?php endif; ?>
    </div> <!-- end list-services -->
</div>