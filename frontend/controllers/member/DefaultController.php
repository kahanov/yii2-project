<?php

namespace frontend\controllers\member;

use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller
{

	public function behaviors(): array
	{
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}

	/**
	 * @return mixed
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}
}
