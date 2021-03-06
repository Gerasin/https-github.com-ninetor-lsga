<!-- <!DOCTYPE html>-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>

    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <!-- Данное значение часто используют поисковые системы, заполняем ответственно -->
        <meta name="description" content="" />
        <!-- Адаптируем страницу для мобильных устройств -->
        <meta name="viewport" content="width=1024, maximum-scale=2.0" />

        <!-- Традиционная иконка сайта, размер 16x16, прозрачность поддерживается. Рекомендуемый формат: .ico -->
        <link rel="shortcut icon" href="/images/favicon.ico" />

        <!-- Иконка сайта для устройств от Apple, рекомендуемый размер 114x114, прозрачность не поддерживается -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png" />

        <!-- Подключаем стили для шрифтов -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,300,300italic,900italic&subset=cyrillic' rel='stylesheet' type='text/css'>

        <!-- Подключаем файлы стилей -->
        <link rel="stylesheet" type="text/css" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/css/modules/chosen.css" />
        <link rel="stylesheet" type="text/css" href="/css/custom.css" />

        <!-- Скрипты -->
        <script type="text/javascript" src="/js/modernizr.custom.js"></script> <!-- Определение возможностей браузера -->
        <script type="text/javascript" src="/js/respond.js"></script>
        <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="/js/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="/js/scripts.js"></script>
        <script type="text/javascript" src="/js/home.js"></script>
        <script type="text/javascript" src="/js/chosen.jquery.min.js"></script>
    </head>


    <body class="main-page">
        <header>
            <?php Yii::app()->user->getUserLogout() ?> 
            <div class="popup-bg"></div>
            <div class="header-bg-line"></div>

            <div class="header-fixed-helper"></div>

            <div class="header-fixed">
                <div class="header-fixed-inner">
                    <a class="logo-main" href="/"></a>

                    <div class="header-top">
                        <ul class="menu-top"> 
                            <?php if(Yii::app()->user->isGuest):?>
                            <li><a class="menu-top-link js-show-enter" href="/login">Вход</a></li>
                            <li><a class="menu-top-link" href="/registration">Регистрация</a></li>                       
                            <?php else:?>
                            <?php $this->renderPartial('/main/_control'); ?>
                            <?php endif;?>
                        </ul> <!-- end menu-top -->
                    </div> <!-- end header top -->

                    <div class="header-bottom">
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'htmlOptions' => array('class' => 'menu-main'),                            
                            'items'=>$this->getMenuItems(1),
                        ));
                        ?>                        
                    </div><!-- end header bottom -->
                </div>
            </div> <!-- end header-inner -->

            <?php echo $content; ?> 

            <footer>
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array('class' => 'footer-menu'),
                    'items'=>$this->getMenuItems(2),
                ));
                ?> 
                <div class="footer-copyright">
                    © 2014 «LSGA»
                    Сделали в <a href="http://nineseven.by/" target="_blank">Nineseven</a>
                </div>
            </footer>
        </header> <!-- end wrapper -->

</body>
</html>


