<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property int $client_id
 * @property int $contract_id
 * @property int $amount
 * @property string $date
 *
 * @property Clients $client
 * @property Contracts $contract
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'contract_id', 'amount', 'date'], 'required'],
            [['client_id', 'contract_id', 'amount'], 'integer'],
            [['date'], 'safe'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['contract_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contracts::className(), 'targetAttribute' => ['contract_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Клиент',
            'contract_id' => '№ договора',
            'amount' => 'Сумма',
            'date' => 'дата',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContract()
    {
        return $this->hasOne(Contracts::className(), ['id' => 'contract_id']);
    }
}
