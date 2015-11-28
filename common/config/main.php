<?php
$rules = array_merge(
    require(__DIR__ . '/../../modules/prod/config/rules.php')
);

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'rules' => $rules,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
    ],
    'modules' => [
        'prod' => [
            'class' => 'modules\prod\Module',
        ],
    ],
];
