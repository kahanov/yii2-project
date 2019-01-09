<?php

use yii\helpers\Url;
use yii\helpers\Html;
use core\entities\user\User;
use core\helpers\UserHelper;
use kartik\date\DatePicker;
use backend\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel">
    <div class="x_title">
        <h2><?= Html::encode($this->title) ?></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			//'filterModel' => $searchModel,
			'layout'=>"\n{pager}\n{summary}\n{items}",
			'summary' => "<p>Показаны {begin} - {end} из {totalCount} записей</p>",
			'tableOptions' => ['class' => 'table dataTable projects'],
			'bordered' => false,
			'striped' => true,
			'filters_html' => Html::a('<span><i class="fa fa-plus"></i>' .Yii::t('backend/info', 'Create User') . '</span>', ['create'], ['class' => 'grid_button']),
			'columns' => [
				[
					'headerOptions' => ['width' => '200'],
					'contentOptions' =>['class' => 'operations'],
					'label' => 'Операции',
					'content' => function($model){

						$url_arr = [
							['url' => Url::to(['view', 'id' => $model->id]), 'label' => 'Смотреть'],
							['url' => Url::to(['update', 'id' => $model->id]), 'label' => 'Редактировать'],
							['url' => Url::to(['delete', 'id' => $model->id]), 'label' => 'Удалить'],
						];

						return GridView::OperationsMenu($url_arr);
					}
				],
				'id',
				[
					'attribute' => 'created_at',
					'label' => 'Дата регистрации',
					'filter' => DatePicker::widget([
						'model' => $searchModel,
						'attribute' => 'date_from',
						'attribute2' => 'date_to',
						'type' => DatePicker::TYPE_RANGE,
						'separator' => '-',
						'pluginOptions' => [
							'todayHighlight' => true,
							'autoclose' => true,
							'format' => 'yyyy-mm-dd',
						],
					]),
					'format' => 'datetime',
				],
				[
					'attribute' => 'username',
					'label' => 'Логин',
					'value' => function (User $model) {
						return Html::a(Html::encode($model->username), ['view', 'id' => $model->id]);
					},
					'format' => 'raw',
				],
				'email:email',
				[
					'attribute' => 'status',
					'label' => 'Статус',
					'filter' => UserHelper::statusList(),
					'value' => function (User $model) {
						return UserHelper::statusLabel($model->status);
					},
					'format' => 'raw',
				],
			],
		]); ?>
    </div>
</div>