<?php
return [
	'class' => 'yii\web\UrlManager',
	'hostInfo' => $params['frontendHostInfo'],
	'enablePrettyUrl' => true,
	'showScriptName' => false,
	'cache' => false,
	'rules' => [
		'' => 'site/index',
		'<_a:about>' => 'site/<_a>',
		'contact' => 'contact/index',

		'signup' => 'auth/signup/request',
		'signup/<_a:[\w-]+>' => 'auth/signup/<_a>',

		'reset' => 'auth/reset/request',
		'reset/<_a:[\w-]+>' => 'auth/reset/<_a>',

		'<_a:login|logout>' => 'auth/auth/<_a>',

		'member' => 'member/default/index',
		'member/<_c:[\w\-]+>' => 'member/<_c>/index',
		'member/<_c:[\w\-]+>/<id:\d+>' => 'member/<_c>/view',
		'member/<_c:[\w\-]+>/<_a:[\w-]+>' => 'member/<_c>/<_a>',
		'member/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => 'member/<_c>/<_a>',

		'<_c:[\w\-]+>' => '<_c>/index',
		'<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
		'<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
		'<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
	],
];
