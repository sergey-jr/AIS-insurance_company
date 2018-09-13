<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */

$this->title = 'Обновление данных клиента: ' . $model->user->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->getShortName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="clients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
