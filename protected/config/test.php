<?php
//test.php
return CMap::mergeArray(
    require 'main.php',
    [
        'components' => [
                'fixture' => ['class' => 'system.test.CDbFixtureManager'],
                'db' => ['connectionString' => 'mysql:host=127.0.0.1; dbname=new_test2_tests'],
            ],
    ]
);