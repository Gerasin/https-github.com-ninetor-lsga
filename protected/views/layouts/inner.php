<!DOCTYPE html>
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
        <link rel="stylesheet" type="text/css" href="/css/modules/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="/css/modules/jquery-ui.theme.css" />

        <!-- Скрипты -->
        <script type="text/javascript" src="/js/modernizr.custom.js"></script> <!-- Определение возможностей браузера -->
        <script type="text/javascript" src="/js/respond.js"></script>
        <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="/js/mediaelement-and-player.min.js"></script>
        <script type="text/javascript" src="/js/jquery.nicescroll.min.js"></script>
        <script type="text/javascript" src="/js/scripts.js"></script>
        <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
        <script type="text/javascript"
                src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDs-4Zu-tfTYmRiiAbs3s_viJnqQOXkhC8&sensor=false">
        </script>
        <script src="/js/admin/ajaxfileupload.js"></script>
        <?php if (Yii::app()->user->isGuest): ?>    
            <script src="/js/register.js"></script>
        <?php endif; ?> 
    </head>


    <body class="register-page">
        <header>
            <?php $this->renderPartial('/main/_main_heder'); ?>
            <div class="header-inner">
                <div class="header-content">
                    <h1 class="header-content-title">
                        <?php echo CHtml::encode($this->pageTitle); ?>
                    </h1>
                </div> <!-- end header content -->
            </div>

        </header>

        <div class="wrapper">
            <div class="content">
                <?php echo $content; ?> 
            </div> <!-- end content -->

            <footer>
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array('class' => 'footer-menu'),
                    'items' => $this->getMenuItems(2),
                ));
                ?> 

                <div class="footer-copyright">
                    © 2014 «LSGA»
                    Сделали в <a href="http://nineseven.by/" target="_blank">Nineseven</a>
                </div>
            </footer>
        </div> <!-- end wrapper -->

    </body>
</html>