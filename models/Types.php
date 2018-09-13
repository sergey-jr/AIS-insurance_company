<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Types".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $price
 *
 * @property Contracts[] $contracts
 */
class Types extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'description' => 'Описание',
            'price' => 'Цена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::className(), ['type_id' => 'id']);
    }
}
