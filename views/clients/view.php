<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */

$this->title = implode(' ', array($model->user->last_name, $model->user->first_name, $model->user->patronymic_name));
if(Yii::$app->user->identity->isAdmin())
    $this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
if(Yii::$app->user->identity->isWorker())
    $this->params['breadcrumbs'][] = ['label' => 'Управление', 'url' => ['site/manager']];
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? if(Yii::$app->user->identity->isAdmin())
            {?>
                <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены что хотите удалить?',
                    'method' => 'post',
                ],
            ]) ?>
            <?}?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute' => 'user_id',
                'value' => $model->user->getFullName()],
            'pd_SNo',
        ],
    ]) ?>

</div>
