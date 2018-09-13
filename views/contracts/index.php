<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Договора';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Все договора', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Заключить договор', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сформировать отчет', ['report_on_contracts'], ['class' => 'btn btn-primary', 'target' => '_new']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'worker_id',
            'value' => function($model){ return $model->worker->user->getShortName(); }],
            ['attribute' => 'filial_id',
            'value' => 'filial.name'],
            ['attribute' => 'type_id',
            'value' => 'type.name'],
            ['attribute' => 'client_id',
            'value' => function($model){ return $model->client->user->getShortName(); }],
            'price',
            ['attribute' => 'date',
            'value' => 'date',
            'format' => ['date','php:d.m.Y'],
            'filter' => DatePicker::widget([ 'model' => $searchModel,
                'language' => 'ru',
                'attribute' => 'date',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]])],
            ['attribute' => 'date_expired',
            'value' => 'date_expired',
            'format' => ['date','php:d.m.Y'],
            'filter' => DatePicker::widget([ 'model' => $searchModel,
                'language' => 'ru',
                'attribute' => 'date',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]])],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
