<?php
$this->pageTitle = $education->name;
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
        <?= $education->name ?>
    </li>
</ul>

<div class="content-main">
    <div class="school school-progress">
        <div class="summary-progress">
            <?= $education->name ?> изучена вами на
            <em><?= number_format($procent, 2, '.', ' ') ?>%</em>
            <div class="bar">
                <span style="width: <?= $procent ?>%;"></span>
            </div>
        </div>
        <h2><strong>Прогресс</strong></h2>

        <table class="school-progress_table">
            <thead>
                <tr>
                    <th>Уровень:</th>
                    <th>Предмет усвоен на:</th>
                    <th class="acenter">Статус завершенности:</th>
                </tr>
                <tr class="legend-row">
                    <td></td>
                    <td>
                        <div class="bar">
                            <i class="bar-75"><span class="legend">75%</span></i>
                            <i class="bar-100"><span class="legend">100%</span></i>
                        </div>
                    </td>
                    <td></td>
                </tr>
            </thead>
            <tbody>  
                <?php foreach ($classroom as $value):
                    ?>
                    <tr>
                        <td><?php echo $value['name'] ?></td>
                        <td>
                            <div class="bar">
                                <span style="width: <?php echo $value['procent'] ?>%;"></span>
                                <i class="bar-75 <?php if ($value['procent'] >= 75): ?>active <?php endif; ?><?php if ($value['procent'] >= 100): ?>complete<?php endif; ?>"></i>
                                <i class="bar-100 <?php if ($value['procent'] >= 100): ?>active<?php endif; ?>"></i>
                            </div>
                        </td>
                        <td class="acenter">
                            <?php if ($value['status'] == 2): ?>
                                <span class="pseudo-button green-contrast"><span>Завершено</span></span>
                            <?php elseif ($value['status'] == 1): ?>
                                <a href="/education/lesson/<?= $value['id'] ?>" class="button dark-green"><span>Идет изучение...</span></a>
                            <?php elseif ($value['status'] == 3): ?>
                                <span class="pseudo-button green-contrast"><span>Завершено</span></span>
                            <?php elseif ($value['status'] == 4): ?>
                                <a href="#" onclick="startLessonUser( < ? = $value['id'] ? > ); return false;" class="button"><span>Начать изучение</span></a>
                               <?php else: ?>
                                <span class="pseudo-button dark-gray"><span>Закончите <?php echo $value['prev_name'] ?></span></span>
                            <?php endif; ?>                                                    
                        </td>
                    </tr>                  
                <?php endforeach; ?>
                <tr class="last-line"><td></td><td></td><td class="acenter"></td></tr>
                <tr class="school-progress_table_dop">
                    <td colspan="2">
                        <i class="credit-ico"></i> — Кредиты. <a href="/about" class="link">Узнать больше о кредитах</a>
                    </td>  
                    <td class="acenter"></td>
                </tr>
            </tbody>
        </table>

        <div class="about-free">
            <p>Данная школа бесплатна, но Вы можете</p>
            <p>
                поддержать нас лайкнув её в 
                
            <div class="pluso" data-background="none;" data-options="small,square,line,horizontal,nocounter,sepcounter=1,theme=14" data-services="vkontakte,odnoklassniki,facebook,twitter,google,email"></div>
            , так-же нам будет очень интересно услышать
            <a href="#" class="popup-open" data-key="write-us">Ваше мнение</a> по поводу школы.
            </p>
            <p>Это даст нам возможность продолжать добавлять в школу новый интересный функционал</p>
        </div>

    </div> <!-- end list-services -->
</div>
<script type="text/javascript" src="/js/ans.js"></script>
<div class="mask_popup"></div>
<div class="popup" id="write-us">
    <article>
        <a class="close"></a>
        <p class="popup-title" id="feedback-title">Напишите нам ваши впечатления от школы</p>
        <form class="standart-form">
            <fieldset class="arightMessage">
                <textarea id="message" placeholder="Возможно вы хотите видеть дополнительную информацию или нашли ошибку..."></textarea>
                <span class="error-text" id="error-text"></span>
            </fieldset>
            <fieldset class="aright">
                <button type="submit" class="btn-simple popup-form-submit" onclick="feedbackUserForm();
                                return false;"><span>Отправить</span></button>
            </fieldset>
        </form>
    </article>
</div>
<div class="popup" id="thanks-to">
    <article>
        <a class="close"></a>
        <p class="popup-title">Вам спасибо!</p>
        <p class="acenter"><a href="#" class="close-popup">Закрыть окно</a></p>
    </article>
</div>