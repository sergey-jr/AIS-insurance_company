<?php

use app\models\Contracts;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Payments */
/* @var $form yii\widgets\ActiveForm */
$clients = (new Query)->
select(['CONCAT_WS(" ", last_name, first_name, patronymic_name) as full_name', 'clients.id as client'])
    ->from('user, client')
    ->where('clients.user_id=user.id')
    ->all();
$clients = ArrayHelper::map($clients, 'client', 'full_name');
$clients_options = [
  'prompt' => 'Выберете клиента'
];
$contracts = ArrayHelper::map(Contracts::find()->all(), 'id', 'id');
$contracts_options = [
        'prompt' => 'Выбирете договор'
];
?>

<div class="payments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList($clients, $clients_options) ?>

    <?= $form->field($model, 'contract_id')->dropDownList($contracts, $contracts_options) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
