<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use core\entities\user\User;
use backend\forms\user\UserSearch;
use yii\web\NotFoundHttpException;
use backend\forms\user\UserEditForm;
use backend\forms\user\UserCreateForm;
use core\services\manage\UserManageService;

class UserController extends Controller
{
	private $service;

	/**
	 * UserController constructor.
	 * @param $id
	 * @param $module
	 * @param UserManageService $service
	 * @param array $config
	 */
	public function __construct($id, $module, UserManageService $service, $config = [])
	{
		parent::__construct($id, $module, $config);
		$this->service = $service;
	}

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::class,
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new UserSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single User model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new User
	 * @return string|\yii\web\Response
	 * @throws \yii\base\Exception
	 */
	public function actionCreate()
	{
		$form = new UserCreateForm();

		if ($form->load(Yii::$app->request->post()) && $form->validate()) {
			try {
				$user = $this->service->create($form);
				return $this->redirect(['view', 'id' => $user->id]);
			} catch (\DomainException $e) {
				Yii::$app->errorHandler->logException($e);
				Yii::$app->session->setFlash('error', $e->getMessage());
			}
		}

		return $this->render('create', [
			'model' => $form,
		]);
	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		$user = $this->findModel($id);

		$form = new UserEditForm($user);
		if ($form->load(Yii::$app->request->post()) && $form->validate()) {
			try {
				$this->service->edit($user->id, $form);
				return $this->redirect(['view', 'id' => $user->id]);
			} catch (\DomainException $e) {
				Yii::$app->errorHandler->logException($e);
				Yii::$app->session->setFlash('error', $e->getMessage());
			}
		}
		return $this->render('update', [
			'model' => $form,
			'user' => $user,
		]);
	}

	/**
	 * Deletes an existing User
	 * @param $id
	 * @return \yii\web\Response
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionDelete($id)
	{
		$this->service->remove($id);

		return $this->redirect(['index']);
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = User::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
