<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Filial".
 *
 * @property int $id
 * @property string $name
 * @property string $place
 *
 * @property Contracts[] $contracts
 */
class Filial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Filial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'place'], 'required'],
            [['name', 'place'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'place' => 'Местоположение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::className(), ['filial_id' => 'id']);
    }
}
