<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FilialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Филиалы';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filial-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Все филиалы', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Добавить филиал', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'place',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
