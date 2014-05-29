<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ppsk',
            'username' => 'devel',
            'password' => 'devel',
            'charset' => 'utf8'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
        ],
    ],
];
