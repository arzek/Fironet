<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '/api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '/users/crete' => 'users/crete',
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user',
                    'except' => ['create','delete'],
                    'extraPatterns' =>
                    [
                    'POST create' => 'create_user',
                    'POST delete' => 'delete_user',
                    ],
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'group','except' => ['create','delete'],
                    'extraPatterns' =>
                        [
                            'POST create' => 'create_group',
                            'POST add-user' => 'add_user',
                            'POST delete-user' => 'delete_user',
                            'POST delete' => 'delete_group',
                        ],
                ],


            ],
        ],

    ],
    'params' => $params,
];
