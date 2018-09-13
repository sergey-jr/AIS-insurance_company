<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\AutoComplete;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
if(Yii::$app->user->identity->isAdmin())
    $this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
if(Yii::$app->user->identity->isWorker())
    $this->params['breadcrumbs'][] = ['label' => 'Управление', 'url' => ['site/manager']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Все клиенты', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Добавить клиента', ['create'], ['class' => 'btn btn-success']) ?>
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
            'pd_SNo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
