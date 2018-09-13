<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contracts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Договора', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-view">

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
            ['attribute' => 'worker_id',
            'value' => $model->worker->user->getFullName(),],
            ['attribute' => 'filial_id',
            'value' => $model->filial->name,],
            ['attribute' => 'type_id',
            'value' => $model->type->name,],
            ['attribute' => 'client_id',
            'value' => $model->client->user->getFullName(),],
            'price',
            'date',
            'date_expired',
        ],
    ]) ?>

</div>
