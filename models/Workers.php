<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "workers".
 *
 * @property int $id
 * @property int $user_id
 * @property string $accepted принят на работу
 * @property string $fired уволен
 * @property string $position должность
 *
 * @property Contracts[] $contracts
 * @property User $user
 */
class Workers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'accepted'], 'required'],
            [['user_id'], 'integer'],
            [['accepted', 'fired'], 'safe'],
            [['position'], 'string', 'max' => 255],
            [['user_id'], 'unique'],
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
            'accepted' => 'Принят',
            'fired' => 'Уволен',
            'position' => 'Должность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contracts::className(), ['worker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
