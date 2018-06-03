<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'showScriptName' => true,
            'enableStrictParsing' => true,
            'rules' => [
                ['pattern' => '', 'route' => 'article/article-list'],
                ['pattern' => 'form', 'route' => 'article/article-form'],
                ['pattern' => 'list', 'route' => 'article/article-list'],
//                ['pattern' => 'admin', 'route' => 'http://test-blog-project/backend/web'],

                ['pattern' => 'logout', 'route' => 'site/logout'],
                ['pattern' => 'login', 'route' => 'site/login'],
                ['pattern' => 'signup', 'route' => 'site/signup'],
                ['pattern' => 'home', 'route' => 'site/index'],
                ['pattern' => 'about', 'route' => 'site/about'],
                ['pattern' => 'contact', 'route' => 'site/contact'],

            ],
        ],

    ],
    'params' => $params,
];
