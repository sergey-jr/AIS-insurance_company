<?php

use app\models\Clients;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Workers */
/* @var $form yii\widgets\ActiveForm */
$options = [
    'prompt' => 'Выберите пользователя'
];
if(!$model->id)
{
    $workers = $model::find()->select('id, user_id')->all();
    $workers = ArrayHelper::map($workers, 'id', 'user_id');
    $clients = ArrayHelper::map(Clients::find()->select('id, user_id')->all(), 'id', 'user_id');
    $users = (new Query)->
    select(['CONCAT_WS(" ", last_name, first_name, patronymic_name) as full_name', 'id'])
        ->from('user')
        ->where(['not in', 'id', array_merge($workers, $clients)])
        ->andFilterWhere(['<>','username','admin']);
}
else{
    $users = (new Query)
        ->select(['CONCAT_WS(" ", last_name, first_name, patronymic_name) as full_name', 'id'])
        ->from('user')
        ->where(['=', 'id', $model->user->id]);
    $options['readonly'] = true;
}

$users_items = ArrayHelper::map($users->all(),
    'id', 'full_name');
?>

<div class="workers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($users_items, $options) ?>

    <?= $form->field($model, 'accepted')->input('date')?>

    <?= $form->field($model, 'fired')->input('date') ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
