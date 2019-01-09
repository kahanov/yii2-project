<?php

$config = [
	'components' => [
		'authClientCollection' => [
			'class' => 'yii\authclient\Collection',
			'clients' => [
				'vk' => [
					'class' => 'yii\authclient\clients\VKontakte',
					'clientId' => '6805883',
					'clientSecret' => 'zodUnV5fndwACQFxJCNh',
				],
			],
		]
	],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
		'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
		'allowedIPs' => ['*'],
    ];
}

return $config;
