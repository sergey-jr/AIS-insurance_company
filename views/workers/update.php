<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Workers */

$this->title = 'Обновление сотрудника: ' . $model->user->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->getShortName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="workers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
