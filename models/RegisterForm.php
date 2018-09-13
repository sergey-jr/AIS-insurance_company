<?
namespace app\models;
header('Content-Type: text/html; charset=utf-8');
use Yii;
use yii\base\Model;

/**
 *
 */
class RegisterForm extends Model
{
  public $username;
  public $FIO;
  public $password;
  /**
   * @return array the validation rules.
   */
  public function rules()
  {
      return [
          [['username', 'password', 'FIO'], 'required'],
          ['username', 'validateUser'],
      ];
  }

  public function validateUser($attribute, $params)
  {
    if (!$this->hasErrors()) {
      if (User::findByUsername($this->username)) {
        $this->addError($attribute, 'Username is already exists.');
      }
    }
  }

  public function register()
  {
      if (!$this->validate()) {
          return null;
      }
        $user = new User;
        $user->username = $this->username;
        list($user->last_name, $user->first_name, $user->patronymic_name) = explode(' ', $this->FIO);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->admin = 0;
        return $user->save() ? $user : null;
  }

  public function attributeLabels()
  {
      return ['username'=>'Логин', 'password'=>'Пароль', 'FIO'=>'ФИО'];
  }
}

?>
