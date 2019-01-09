<?php

/* @var $this yii\web\View */
/* @var $model core\entities\user\User */

/* @var $model backend\forms\user\UserEditForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Update User: ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="x_panel">
    <div class="x_title">
        <h2><?= Html::encode($this->title) ?></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'form-horizontal form-label-left',
                    'novalidate' => ''
                ],
                //'enableClientValidation' => false,
                'fieldConfig' => [
                    'options' => ['class' => 'item form-group'],
                    'template' => '{label}<div class="col-md-6 col-sm-6 col-xs-12">{input}</div>',
                    'labelOptions' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
                    'inputOptions' => ['class' => 'form-control col-md-7 col-xs-12'],
                ],
            ]); ?>

            <?= $form->
            field($model, 'username')->
            label('Логин <span class="required">*</span>')->
            textInput(['maxLength' => true]) ?>

            <?= $form->
            field($model, 'email')->
            label('Email <span class="required">*</span>')->
            textInput(['maxLength' => true]) ?>

            <div class="ln_solid"></div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <?= Html::submitButton(Yii::t('backend/user', 'Сохранить'), ['class' => 'btn btn-success']) ?>
                    <a href="#" class="btn btn-primary">Cancel</a>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
