<?php
return [
    'aliases' => [
                    '@bower' => '@vendor/bower-asset',
                    '@npm'   => '@vendor/npm-asset',
                  ],
     'modules' => [
                        'gridview' => ['class' => 'kartik\grid\Module'],
                        'comments' => ['class' => 'yeesoft\comments\Comments',
                            //  'enableSpamProtection' => true,
                                      ],
                        'formatter'=>[
                                      'class'=>'yii\i18n\formatter',
                                      'currencyCode'=>'$'

                                      ],
                        'rbac' => [
                                      'class'    => 'yii2mod\rbac\Module',
                                   /*   'as access' => [
                                                      'class' => \yii2mod\rbac\filters\AccessControl::class
                                                     ],*/
                                  ],  
            
                    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language'=>'es',
    'components' => [
                    'cache' => [
                                'class' => 'yii\caching\FileCache',
                                ],
                     'authManager' => [
                                            'class' => 'yii\rbac\DbManager',
                                            'defaultRoles' => ['guest', 'user'],
                                        ],
                     'i18n' => [
                                    'translations' => [
                                                    'yii2mod.rbac' => [
                                                                        'class' => 'yii\i18n\PhpMessageSource',
                                                                        'basePath' => '@yii2mod/rbac/messages',
                                                                    ],
                                        // ...
                                                        ],
                                ],

    ],
   /* 'as access' => [
                        'class' => \yii2mod\rbac\filters\AccessControl::class,
                        'allowActions' => [
                           'site/*',
                            // The actions listed here will be allowed to everyone including guests.
                            // So, 'admin/*' should not appear here in the production, of course.
                            // But in the earlier stages of your development, you may probably want to
                            // add a lot of actions here until you finally completed setting up rbac,
                            // otherwise you may not even take a first step.
                        ]
                     ],*/
];
