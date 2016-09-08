<?php

// include Yii bootstrap file
require_once(dirname(__FILE__).'/../framework/yii.php');

Yii::setPathOfAlias('protected', dirname(__DIR__)."/protected");
Yii::setPathOfAlias('viewsLayouts', dirname(__DIR__)."/protected".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."layouts");
Yii::setPathOfAlias('modules', dirname(__DIR__)."/protected".DIRECTORY_SEPARATOR."modules");
Yii::setPathOfAlias('configPath', dirname(__DIR__)."/protected".DIRECTORY_SEPARATOR."config");


$config=dirname(__FILE__).'/../protected/config/main.php';

// create a Web application instance and run
Yii::createWebApplication( $config )->run();