<?php Yii::app()->user->getUserLogout() ?>     
<div class="popup-bg"></div>
<?php if(Yii::app()->user->isGuest): ?>
<?php $this->renderPartial('/user/_login_form'); ?>
<?php endif; ?>
<div class="header-bg-line"></div>
<div class="header-fixed-helper"></div>
<div class="header-fixed">
    <div class="header-fixed-inner">
        <a class="logo-main" href="/"></a>

        <div class="header-top">
            <ul class="menu-top"> 
                <?php if(Yii::app()->user->isGuest): ?>                                                 
                <li><a class="menu-top-link js-show-enter" href="/login">Вход</a></li>
                <li><a class="menu-top-link" href="/registration">Регистрация</a></li>                       
                <?php else: ?>
                <?php $this->renderPartial('/main/_control'); ?>
                <?php endif; ?>                        
            </ul> <!-- end menu-top -->
        </div> <!-- end header top -->

        <div class="header-bottom">
            <?php
            $this->widget('zii.widgets.CMenu', array(
            'htmlOptions' => array('class' => 'menu-main'),
            'items' => $this->getMenuItems(1),
            ));
            ?>     
        </div><!-- end header bottom -->
    </div>
</div> <!-- end header-inner -->