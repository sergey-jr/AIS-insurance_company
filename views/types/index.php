<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виды договоров';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="types-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Все виды', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Добавить вид', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description:ntext',
            'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
