<?php

use core\helpers\UserHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\entities\user\User */
$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
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

    <p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
    </p>
    <div class="x_content">
        <div class="col-md-12 col-lg-12 col-sm-12">
			<?= DetailView::widget([
				'model' => $model,
				'attributes' => [
					'id',
					'username',
					'email:email',
					[
						'attribute' => 'status',
						'value' => UserHelper::statusLabel($model->status),
						'format' => 'raw',
					],
					'created_at:datetime',
					'updated_at:datetime',
				],
			]) ?>
        </div>
    </div>
</div>