<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property int $user_id
 * @property string $pd_SNo Серия, номер паспорта
 *
 * @property User $user
 * @property Contracts[] $contracts
 * @property Payments[] $payments
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'pd_SNo'], 'required'],
            [['user_id'], 'integer'],
            [['pd_SNo'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
            [['pd_SNo'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'pd_SNo' => 'Паспорт(серия, номер)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['client_id' => 'id']);
    }
}
