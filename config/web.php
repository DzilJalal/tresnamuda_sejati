<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => "Tresnamuda Group",
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    // 'timeZone' => 'Asia/Jakarta',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'mimin' => [
            'class' => '\hscstudio\mimin\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'hrd' => [
            'class' => 'app\modules\hrd\Module',
        ],
        'it' => [
            'class' => 'app\modules\it\Module',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // only support DbManager
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'bKZ_sw0eLxC9HZK2_mQN4ECnySSb9an2',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        // 'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
             'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.tresnamuda.co.id',
                'username' => 'itjkt@tresnamuda.co.id',
                'password' => 'Itj170711',
                'port' => '587',
                'encryption' => 'tls',
                'streamOptions' => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ],
            ],
            
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
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php: d-m-Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'thousandSeparator' => ",",
            'decimalSeparator' => '.',
            'currencyCode' => "Rp.",
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 0,
                NumberFormatter::MAX_FRACTION_DIGITS => 2,
            ]
        ],
        // 'view' => [
        // 'theme' => [
        //      'pathMap' => [
        //         '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
        //          ],
        //      ],
        // ],
        'db' => require(__DIR__ . '/db.php'), // Defautlnya di taruh ke dalam database milik IT
        'db_hrd' => require(__DIR__ . '/db_hrd.php'),
    /*
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     */
    ],
    'as access' => [
        'class' => '\hscstudio\mimin\components\AccessControl',
        'allowActions' => [
            // add wildcard allowed action here!
            "site/*",
            'debug/*',
            'mimin/*', // only in dev mode
        // 'site/login',
        // 'site/logout'
        ],
    ],
    'params' => $params,
];

 //if (YII_ENV_DEV) {
 //  // configuration adjustments for 'dev' environment
 //  $config['bootstrap'][] = 'debug';
 //  $config['modules']['debug'] = [
 //      'class' => 'yii\debug\Module',
 //  ];

 //  $config['bootstrap'][] = 'gii';
 //  $config['modules']['gii'] = [
 //      'class' => 'yii\gii\Module',
 //      'allowedIPs' => ['127.0.0.1', "::1", "10.60.36.79", "10.60.36.220"]
 //  ];
 //}

return $config;
