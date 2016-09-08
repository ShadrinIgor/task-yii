<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Yii',
    'sourceLanguage' => 'ru',
    'language' => 'ru',
    // Название темы
    'theme' => 'classic',
    // preloading 'log' component
    'preload'=>array('log'),

    'defaultController'=>'site',

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
    ),

    'modules'=>array(
        //'user', 'console', 'catalog', 'subscribe', 'find',
        // uncomment the following to enable the Gii tool


        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'6223772',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),


    ),

    // application components
    'components'=>array(

        'cache'=>array('class'=>'system.caching.CFileCache'),

/*        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'class' => 'MyCWebUser'
        ),*/
        // uncomment the following to enable URLs in path-format

        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName' => false,
            'rules'=>array(
                'gii'=>'gii',
                'gii/<controller:\w+>'=>'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',

                ''=>'site/index',

                'new-year'=> 'newYear/index',
                'new-year.html'=> 'newYear/index',
                '<language:(en|ja|zh)>/'=> 'languages/',
                '<language:(en|ja|zh)>/([\w/\-\?&=\.])+'=> 'languages/',
                '<slug:\w+>.html'=> 'page',
            ),
        ),

        // uncomment the following to use a MySQL database
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=new_test2',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),

        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CEmailLogRoute',
                    'levels'=>'error, warning',
                    'emails'=>'support@site.ru',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'trace, info',
                    'categories'=>'system.*',
                ),
/*                array(
                    'class'=>'CWebLogRoute',
                ),*/
                // uncomment the following to show log messages on web pages
            ),
        ),

        'assetManager'=>array(
            'basePath'=>realpath(dirname(dirname(dirname(__FILE__))).'/httpdocs/assets'),
        ),

        'notifications'=>array(
            'class'     => 'ext.notifications.initNotifications'
        ),

    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(

        "baseUrl"=>"http://task-yii/",

        /*
        * для кэширования виджетов, все что вам надо, это добавить массив с названием виджета, без прифекса _Widget
        * и указать параметры:
        * duration: Время жизни кэша
        * cacheID: ИД номер типа кэша
        * в данный момент доступны следующие ID:
        * CDummyCache - Пустышка, не производит кэширование данных (так же можно удалить массив с виджетом, тогда по дефолту ему выстовится CDummyCache)
        * CFileCache - Кэширование по средством файлов
        *
        * что бы добавить свой тип кэширования, необходимо в компоненты добавить следующую строчку:
        * 'CFileCache' => array('class' => 'CFileCache')  т.е. 'cacheID' => array('class' => 'ClassName'),
    */
        'widgetList' => array(
/*            'blocksnewswidget' => array(
                'duration' => 86400,
                'cacheID' => 'CFileCache',
            ),*/
        ),
    ),

    'controllerMap'=>array(
        'min'=>array(
            'class'=>'ext.minScript.controllers.ExtMinScriptController',
        ),
    ),

);