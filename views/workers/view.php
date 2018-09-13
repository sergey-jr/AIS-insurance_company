<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Workers */

$this->title = implode(' ', array($model->user->last_name, $model->user->first_name, $model->user->patronymic_name));
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute' => 'user_id',
                'value' => $model->user->getFullName()],
            ['attribute' => 'accepted',
            'format' => ['date', 'php:d.m.Y']],
            ['attribute' => 'fired',
            'format' => ['date', 'php:d.m.Y']],
            'position',
        ],
    ]) ?>

</div>
