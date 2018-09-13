<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Админ панель';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-admin">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-3">
            <?= Html::a("GII",['gii/']) ?>
        </div>
        <div class="col-lg-3">
            <?= Html::a('Филиал', ['filial/index']) ?>
        </div>
        <div class="col-lg-3">
            <?= Html::a('Виды договоров', ['types/index']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <?= Html::a('Пользователи', ['user/index']) ?>
        </div>
        <div class="col-lg-3">
            <?= Html::a('Сотрудники', ['workers/index']) ?>
        </div>
        <div class="col-lg-3">
            <?= Html::a('Клиенты', ['clients/index']) ?>
        </div>
        <div class="col-lg-3">
            <?= Html::a('Договора', ['contracts/index'])?>
        </div>
        <div class="col-lg-3">
            <?= Html::a('Платежи', ['payments/index'])?>
        </div>
    </div>
</div>
