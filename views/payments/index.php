<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Платежи';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Все платежи',['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Добавить платеж', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сформировать отчет', ['report_on_payments'], ['class' => 'btn btn-primary', 'target' => '_new']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'client_id',
                'value' => function($model){ return $model->client->user->getShortName(); }],
            'contract_id',
            'amount',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
