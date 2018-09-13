<?php

use app\models\Workers;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */
/* @var $form yii\widgets\ActiveForm */
$options = [
    'prompt' => 'Выберите пользователя'
];
if(!$model->id)
{
    $clients = $model::find()->select('id, user_id')->all();
    $clients = ArrayHelper::map($clients, 'id', 'user_id');
    $workers = ArrayHelper::map(Workers::find()->select('id, user_id')->all(), 'id', 'user_id');
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

<div class="clients-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($users_items, $options) ?>

    <?= $form->field($model, 'pd_SNo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
