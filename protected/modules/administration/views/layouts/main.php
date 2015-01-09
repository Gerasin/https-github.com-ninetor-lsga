<!DOCTYPE html>
<html>
    <head>
        <title>Administration Panel</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <script src="/js/admin/jquery-1.11.0.js"></script>
        <script src="/js/admin/bootstrap.min.js"></script>
        <script src="/js/admin/plugins/morris/raphael.min.js"></script>
        <script src="/js/admin/plugins/morris/morris.min.js"></script>
        <script src="/js/admin/plugins/morris/morris-data.js"></script>
        <script src="/js/admin/profile.js"></script>
        <script src="/js/admin/ajaxfileupload.js"></script>

        <link href="/css/admin/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="/css/admin/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="/css/admin/plugins/morris.css" rel="stylesheet">
        <link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- перетаскивам все-->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>

        <script type="text/javascript" src="/js/admin/jquery.tablednd_0_5.js"></script>
        <script type="text/javascript" src="/js/admin/table-dnd-example.js"></script>
        <link type="text/css" rel="stylesheet" href="/css/admin/table-dnd-example.css" />
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/administration">Administration Panel</a>                    
                </div>
                <a class="logo-main"></a>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="/administration/pagesText" <?php if (Yii::app()->controller->action->id=="pagesText") echo 'class="active"'; ?>>Текстовые страницы</a>
                        </li>
                        <li>
                            <a href="/administration/menu/category" <?php if (Yii::app()->controller->action->id=="menuCategory") echo 'class="active"'; ?>>Меню</a>
                        </li>
                        <li>
                            <a href="/administration/" <?php if (Yii::app()->controller->action->id=="index") echo 'class="active"'; ?>>Опросы</a>
                        </li>
                        <li>
                            <a href="/administration/users" <?php if (Yii::app()->controller->action->id=="users") echo 'class="active"'; ?>>Пользователи</a>
                        </li>
                        <li>
                            <a href="/administration/education" <?php if (Yii::app()->controller->action->id=="education") echo 'class="active"'; ?>>Школа(образование)</a>
                        </li>
                        <li>
                            <a href="/administration/classroom" <?php if (Yii::app()->controller->action->id=="classroom") echo 'class="active"'; ?>>Классы/Экзамены</a>
                        </li>
                        <li>
                            <a href="/administration/lesson" <?php if (Yii::app()->controller->action->id=="lesson") echo 'class="active"'; ?>>Уроки</a>
                        </li>
                        <li>
                            <a href="/administration/feedback" <?php if (Yii::app()->controller->action->id=="feedback") echo 'class="active"'; ?>>Обратная связь</a>
                        </li>
                        <li>
                            <a href="/administration/category" <?php if (Yii::app()->controller->action->id=="category") echo 'class="active"'; ?>>Категории</a>
                        </li>
                        <li>
                            <a href="/administration/pages" <?php if (Yii::app()->controller->action->id=="pages") echo 'class="active"'; ?>>Страницы категории</a>
                        </li>
                        <li>
                            <a href="/administration/settings" <?php if (Yii::app()->controller->action->id=="editSettings") echo 'class="active"'; ?>>Настройки</a>
                        </li>
                        <li>
                            <a href="/administration/mainBlocks" <?php if (Yii::app()->controller->action->id=="mainBlocks") echo 'class="active"'; ?>>Блоки на главной странице</a>
                        </li>
                        <li></br><span id="blockPosition"><b>Позиции сохранены</b></span></li>
                        <li></br><span id="blockError"><b>Данные не сохранились</b></span></li>
                        <li id="blockLoader"><img src="/images/loader.gif"></li>
                    </ul>

                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <!-- CONTENT -->
            <?php echo $content; ?>
            <!-- CONTENT  END -->
            <footer>
                <div class="footer-copyright">
                    © 2014 «LSGA»
                    Сделали в <a href="http://nineseven.by/" target="_blank">Nineseven</a>
                </div>
            </footer>
        </div>  

    </body>
</html>