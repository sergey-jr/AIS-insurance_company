<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contracts".
 *
 * @property int $id
 * @property int $worker_id
 * @property int $filial_id
 * @property int $type_id
 * @property int $client_id
 * @property int $price страховая сумма
 * @property string $date дата заключения договора
 * @property string $date_expired дата завершения договора
 *
 * @property Clients $client
 * @property Filial $filial
 * @property Types $type
 * @property Workers $worker
 */
class Contracts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contracts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['worker_id', 'filial_id', 'type_id', 'client_id', 'price', 'date', 'date_expired'], 'required'],
            [['worker_id', 'filial_id', 'type_id', 'client_id', 'price'], 'integer'],
            [['date', 'date_expired'], 'safe'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['filial_id'], 'exist', 'skipOnError' => true, 'targetClass' => Filial::className(), 'targetAttribute' => ['filial_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['worker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Workers::className(), 'targetAttribute' => ['worker_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'worker_id' => 'Сотрудник',
            'filial_id' => 'Филиал',
            'type_id' => 'Вид договора',
            'client_id' => 'Клиент',
            'price' => 'Сумма страхования',
            'date' => 'Дата заключения договора',
            'date_expired' => 'Дата окончания договора',
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
    public function getFilial()
    {
        return $this->hasOne(Filial::className(), ['id' => 'filial_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Types::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(Workers::className(), ['id' => 'worker_id']);
    }
}
