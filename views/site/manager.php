<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Workers;

$worker = Workers::findOne(['user_id' => Yii::$app->user->id]);

$this->title = 'Управление';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-admin">
    <h1><?= Html::encode($this->title) ?></h1>
    <? if(strpos($worker->position, 'a') !== false){ ?>
        <div class="row">
            <div class="col-lg-3">
                <?= Html::a('Пользователи', ['user/index']) ?>
            </div>
            <div class="col-lg-3">
                <?= Html::a('Клиенты', ['clients/index']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= Html::a('Договора', ['contracts/index'])?>
            </div>
            <div class="col-lg-3">
                <?= Html::a('Платежи', ['payments/index'])?>
            </div>
        </div>
    <?}?>
</div>
