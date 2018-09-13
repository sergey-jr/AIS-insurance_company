<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Types */

$this->title = 'Обновление вида договора: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Виды договоров', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
