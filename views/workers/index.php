<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\AutoComplete;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Все сотрудники', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Добавить сотрудника', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сформировать отчет', ['report_on_workers'], ['class' => 'btn btn-primary', 'target' => '_new']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' =>'user_id',
            'value' => function($model){
                return $model->user->getFullName();},
            'filter' => AutoComplete::widget([
                'model' =>$searchModel,
                'attribute' => 'user_id',
                'clientOptions' => [
                    'source' => $users,
                ],
                'options'=>[
                    'class'=>'form-control'
                ]])],
            ['attribute' => 'accepted',
            'value' => 'accepted',
            'format' => ['date','php:d.m.Y'],
            'filter' => DatePicker::widget([ 'model' => $searchModel,
                'language' => 'ru',
                'attribute' => 'accepted',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]])],
            ['attribute' => 'fired',
            'value' => 'fired',
            'format' => ['date','php:d.m.Y'],
            'filter' => DatePicker::widget([ 'model' => $searchModel,
                'language' => 'ru',
                'attribute' => 'fired',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]]),
            ],
            'position',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
