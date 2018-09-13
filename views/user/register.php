<?

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Заполните поля для нового пользователя:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'FIO')->textInput(['placeholder'=>'Иванов Иван Иванович', 'pattern'=>'[А-Я]{1}[а-я]{1,} [А-Я]{1}[а-я]{1,} [А-Я]{1}[а-я]{1,}']) ?>
    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>'Login']) ?>
    <?= $form->field($model, 'password')->passwordInput(['pattern'=>'(?=.*[a-z])(?=.*[A-Z]).{6,20}']) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
