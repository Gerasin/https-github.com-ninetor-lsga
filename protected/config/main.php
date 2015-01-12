<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'LSGA',
    'sourceLanguage' => 'en',
    'language' => 'ru',
    'charset' => 'utf-8',
    
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.imageHandler.CImageHandler',
        'zii.widgets.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'password',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('::1', '127.0.0.1'),
        ),
        'administration' => array(),
    ),
    // application components
    'components' => array(
        'ih' => array('class' => 'CImageHandler'),
        'user' => array(
            'class' => 'MyWebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'authTimeout' => 432000,
        ),
        'authManager' => array(
            'class' => 'LsgaAuthManager',
            'defaultRoles' => array('guest'),
        ),
        'goods_manager' => array(
            'class' => 'application.components.GoodsManager'
        ),
        'user_manager' => array(
            'class' => 'application.components.UserManager'
        ),
        'education' => array(
            'class' => 'application.components.Education'
        ),
        'proposal_manager' => array(
            'class' => 'application.components.ProposalManager'
        ),
        'ih' => array(
            'class' => 'CImageHandler',
        ),
        'mail_manager' => array(
            'class' => 'application.components.MailManager'
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName'=>false,
            'rules' => array(
                '/' => 'main/index', ///               
                'registration' => 'user/Registation', ///
                'login' => 'user/Login', ///
                'settings' => 'profile/ProfileSettings', ///                
                'about' => 'pagesText/about', ///
                'sitemap' => 'pagesText/sitemap', ///
                'contacts' => 'pagesText/contacts', ///
                'dealers' => 'pagesText/dealers', ///
//                'shop/<page:\d+>' => 'shop/index', ///
                'shop' => 'shop/index', ///
//              'shop?page=<page:\d+>' => 'shop/index', ///
                'education' => '/education/index', ///
                'education/category/<id:\d+>' => '/education/category', ///
                'education/lesson/<cid:\d+>/<id:\d+>' => '/education/lessonList', ///
                'education/lesson/<cid:\d+>' => '/education/lessonList', ///
                'education/exam/<id:\d+>' => '/problem/index', ///
                'category/<id:\d+>' => '/category/index', ///
                'category/page/<id:\d+>' => '/category/page', ///               
                'administration/' => 'administration/dashboard/index', //
                'administration/mainBlocks' => 'administration/adminCompany/mainBlocks', //
                'administration/mainBlocks/add' => 'administration/adminCompany/addMainBlocks', //
                'administration/mainBlocks/delete/<id:\d+>' => 'administration/adminCompany/deleteMainBlocks', //
                'administration/mainBlocks/edit/<id:\d+>' => 'administration/adminCompany/editMainBlocks', //
                'administration/mainBlocks/posts/add/<id:\d+>' => 'administration/adminCompany/AddPostsMainBlocks', //
                'administration/mainBlocks/posts/edit/<id:\d+>' => 'administration/adminCompany/editPostsMainBlocks', //
                'administration/mainBlocks/posts/update/<id:\d+>' => 'administration/adminCompany/updatePostsMainBlocks', //
                'administration/mainBlocks/posts/delete/<id:\d+>' => 'administration/adminCompany/deletePostsMainBlocks', //
                'administration/home/edit' => 'administration/dashboard/editHome', //
                'administration/homeproblem/add' => 'administration/dashboard/addProblem',
                'administration/homeproblem/formadd' => 'administration/dashboard/problemFormAdd',
                'administration/homeproblem/edit/<id:\d+>' => 'administration/dashboard/editProblem',
                'administration/homeproblem/update/<id:\d+>' => 'administration/dashboard/updateProblem',
                'administration/homeproblem/delete/<id:\d+>' => 'administration/dashboard/deleteHomeProblem',
                'administration/company' => 'administration/adminCompany/index',                
                'administration/education' => 'administration/adminCompany/education', //
                'administration/education/add' => 'administration/adminCompany/addEducation', //
                'administration/education/edit/<id:\d+>' => 'administration/adminCompany/editEducation', //
                'administration/education/update/<id:\d+>' => 'administration/adminCompany/updateEducation', //
                'administration/education/delete/<id:\d+>' => 'administration/adminCompany/deleteEducation', //
                'administration/classroom' => 'administration/adminCompany/classroom', //
                'administration/classroom/add' => 'administration/adminCompany/addClassroom', //
                'administration/classroom/edit/<id:\d+>' => 'administration/adminCompany/editClassroom', //
                'administration/classroom/update/<id:\d+>' => 'administration/adminCompany/updateClassroom', //
                'administration/classroom/delete/<id:\d+>' => 'administration/adminCompany/deleteClassroom', //
                'administration/lesson' => 'administration/adminCompany/lesson', //
                'administration/lesson/add' => 'administration/adminCompany/addLesson', //
                'administration/lesson/edit/<id:\d+>' => 'administration/adminCompany/editLesson', //
                'administration/lesson/update/<id:\d+>' => 'administration/adminCompany/updateLesson', //
                'administration/lesson/delete/<id:\d+>' => 'administration/adminCompany/deleteLesson', //                
                'administration/problem/<id:\d+>' => 'administration/adminCompany/problem', //
                'administration/problem/add/<id:\d+>' => 'administration/adminCompany/addProblem', //
                'administration/problem/formadd' => 'administration/adminCompany/problemFormAdd', //
                'administration/problem/edit/<id:\d+>' => 'administration/adminCompany/editProblem', //
                'administration/problem/update/<id:\d+>' => 'administration/adminCompany/updateProblem', //                
                'administration/feedback' => 'administration/adminCompany/feedback', //
                'administration/feedback/delete/<id:\d+>' => 'administration/adminCompany/deleteFeeback', //                
                'administration/category' => 'administration/adminCompany/category', //
                'administration/category/add' => 'administration/adminCompany/addCategory', //
                'administration/category/edit/<id:\d+>' => 'administration/adminCompany/editCategory', //
                'administration/category/update/<id:\d+>' => 'administration/adminCompany/updateCategory', //
                'administration/category/delete/<id:\d+>' => 'administration/adminCompany/deleteCategory', //                
                'administration/properties' => 'administration/adminCompany/properties', //
                'administration/properties/add' => 'administration/adminCompany/addProperties', //
                'administration/properties/edit/<id:\d+>' => 'administration/adminCompany/editProperties', //
                'administration/properties/update/<id:\d+>' => 'administration/adminCompany/updateProperties', //
                'administration/properties/delete/<id:\d+>' => 'administration/adminCompany/deleteProperties', //                
                'administration/pages' => 'administration/adminCompany/pages', //
                'administration/pages/add' => 'administration/adminCompany/addPages', // 
                'administration/pages/addform' => 'administration/adminCompany/addPagesForm', // 
                'administration/pages/edit/<id:\d+>' => 'administration/adminCompany/editPages', //
                'administration/pages/update/<id:\d+>' => 'administration/adminCompany/updatePages', //
                'administration/pages/delete/<id:\d+>' => 'administration/adminCompany/deletePages', //                
                'administration/comments/<id:\d+>' => 'administration/adminCompany/commentsPage', //
                'administration/comments' => 'administration/adminCompany/comments', //
                'administration/comments/delete/<id:\d+>' => 'administration/adminCompany/deleteComments', //                               
                'administration/users' => 'administration/adminUser/index', //
                'administration/user/detail/<id:\d+>' => 'administration/adminUser/UserDetail', //
                'administration/user/edit/<id:\d+>' => 'administration/adminUser/UserEdit', //
                'administration/user/user_update/<id:\d+>' => 'administration/adminUser/UserUpdate', //  
                'administration/user/delete/<id:\d+>' => 'administration/adminUser/deleteUser', // 
                'administration/menu/category' => 'administration/adminCompany/menuCategory', //
                'administration/menu/<id:\d+>' => 'administration/adminCompany/menu', //
                'administration/menu/add' => 'administration/adminCompany/addMenu', // 
                'administration/menu/addform' => 'administration/adminCompany/addMenuForm', // 
                'administration/menu/edit/<id:\d+>' => 'administration/adminCompany/editMenu', //
                'administration/menu/update/<id:\d+>' => 'administration/adminCompany/updateMenu', //
                'administration/menu/delete/<id:\d+>' => 'administration/adminCompany/deleteMenu', //                 
                'administration/pagesText' => 'administration/adminCompany/pagesText', //
                'administration/pagesText/add' => 'administration/adminCompany/addPagesText', // 
                'administration/pagesText/addform' => 'administration/adminCompany/addPagesTextForm', // 
                'administration/pagesText/edit/<id:\d+>' => 'administration/adminCompany/editPagesText', //
                'administration/pagesText/update/<id:\d+>' => 'administration/adminCompany/updatePagesText', //
                'administration/pagesText/delete/<id:\d+>' => 'administration/adminCompany/deletePagesText', // 
                'administration/settings' => 'administration/adminCompany/editSettings', // 

                'administration/shopCategory' => 'administration/adminShop/shopCategory', //
                'administration/shopCategory/add' => 'administration/adminShop/shopCategoryAdd', //
                'administration/shopCategory/add/<id:\d+>' => 'administration/adminShop/shopCategoryAdd', //
                'administration/shopCategory/edit/<id:\d+>' => 'administration/adminShop/shopCategoryEdit', //
                'administration/shopCategory/delete/<id:\d+>' => 'administration/adminShop/shopCategoryDelete', //




                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
        // uncomment the following to use a MySQL database
        'db' => require(dirname(__FILE__) . '/db.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'main/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
