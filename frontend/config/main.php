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
//    'language' => 'uz',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
//            'baseUrl' => ''
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
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@frontend/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => []
                ],
                'yii\bootstrap5\BootstrapPluginAsset' => [
                    'js' => [],
                ],
                'yii\bootstrap5\BootstrapAsset' => [
                    'css' => [],
                ]
            ],
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['en', 'ru', 'uz'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
//                'home' => 'site/index',
//                'about' => 'site/about',
//                'contact' => 'site/contact',
//                'postlar' => 'post/list',
//                'kirish' => 'site/login',
//                'posts' => 'post/index',
//                'posts/<id:\d+>' => 'post/update',
//                'view/<id:\d+>' => 'post/view'
            ],
        ],
    ],
    'on beforeRequest' => function($event){
        $session = Yii::$app->session;
        if ($session->has('lang')){
            Yii::$app->language = $session['lang'];
        }
    },
    'modules' => [
        'billing' => [
            'class' => 'frontend\modules\billing\Billing',
//            'viewPath' => '@frontend/modules/billing/views',
        ],
    ],


    'params' => $params,
];
