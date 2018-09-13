<?php

use app\models\Filial;
use app\models\Types;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contracts */
/* @var $form yii\widgets\ActiveForm */
$types = ArrayHelper::map(Types::find()->all(), 'id', 'name');
$types_options = [
        'prompt' => 'Выберите вид страхования'
];
$filials = ArrayHelper::map(Filial::find()->all(), 'id', 'name');
$filials_options = [
        'prompt' => 'Выбирете филиал'
];
if(Yii::$app->user->identity->isAdmin())
{
    $workers = (new Query)
        ->select(['CONCAT_WS(" ", last_name, first_name, patronymic_name) as full_name', 'workers.id as value'])
        ->from(['user', 'workers'])
        ->where('user.id=workers.user_id')
        ->all();
    $workers_options = [
        'prompt' => 'Выбирете сотрудника'
    ];
}
if(Yii::$app->user->identity->isWorker())
{
    $workers = (new Query)
        ->select(['CONCAT_WS(" ", last_name, first_name, patronymic_name) as full_name', 'workers.id as value'])
        ->from(['user', 'workers'])
        ->where('user.id=workers.user_id')->andFilterWhere(['user.id'=>Yii::$app->user->id])
        ->all();
    $workers_options = [
        'readonly' => true
    ];
}
$workers = ArrayHelper::map($workers, 'value','full_name');
$clients = (new Query)
    ->select(['CONCAT_WS(" ", last_name, first_name, patronymic_name) as full_name', 'clients.id as value'])
    ->from(['user', 'clients'])
    ->where('user.id=clients.user_id')
    ->all();
$clients = ArrayHelper::map($clients, 'value', 'full_name');
$clients_options = [
        'prompt' => 'Выбирете клиента'
];
//if($model->id)
//{
//    $clients_options['readonly'] = true;
//    $workers_options['readonly'] = true;
//    $filials_options['readonly'] = true;
//    $types_options['readonly'] = true;
//}
?>

<div class="contracts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'worker_id')->dropDownList($workers, $workers_options) ?>

    <?= $form->field($model, 'filial_id')->dropDownList($filials, $filials_options) ?>

    <?= $form->field($model, 'type_id')->dropDownList($types, $types_options)?>

    <?= $form->field($model, 'client_id')->dropDownList($clients, $clients_options) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'date')->input('date') ?>

    <?= $form->field($model, 'date_expired')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
