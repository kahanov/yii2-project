<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use backend\widgets\Menu;

?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <?= Html::a('<i class="fa fa-paw"></i><span>' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'site_title']) ?>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="http://placehold.it/128x128" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= Yii::$app->user->identity->username ?></h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3>General</h3>
                <?=
                Menu::widget(
                    [
                        "items" => [
                            ["label" => Yii::t('common', 'Главная'), "url" => Url::to(['/']), "icon" => "home"],
//							[
//								"label" => Yii::t('backend/settings', 'Настройки'),
//								"url" => "javascript:void(0);",
//								"icon" => "cogs",
//								"items" => [
//									[
//										"label" => Yii::t('backend/settings', 'Основные'),
//										"url" => Url::to(['/settings']),
//									],
//								],
//							],
                            ['label' => 'Users', 'icon' => 'user', 'url' => ['/user/index'], 'active' => $this->context->id == 'user'],
//							[
//								"label" => Yii::t('backend/info', 'Информация'),
//								"url" => "javascript:void(0);",
//								"icon" => "question-circle",
//								"items" => [
//									[
//										"label" => Yii::t('backend/info', 'Управление'),
//										"url" => Url::to(['/info']),
//									],
//									[
//										"label" => Yii::t('backend/info', 'Разработчику'),
//										"url" => "javascript:void(0);",
//										"items" => [
//											[
//												"label" => Yii::t('backend/info', 'Виджеты'),
//												"url" => "javascript:void(0);",
//												"items" => [
//													["label" => "Menu", "url" => ["site/menu"]],
//													["label" => "Panel", "url" => ["site/panel"]],
//												],
//											],
//										],
//									],
//								],
//							],
                        ],
                    ]
                )
                ?>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a href="<?= Url::to(['/settings']) ?>" data-toggle="tooltip" data-placement="top"
               title="<?= Yii::t('backend/settings', 'Настройки') ?>">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <?= Html::a(
                '<span class="glyphicon glyphicon-off" aria-hidden="true"></span>',
                ['/auth/logout'],
                [
                    'data-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'title' => Yii::t('login', 'Выйти')
                ]
            ) ?>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
