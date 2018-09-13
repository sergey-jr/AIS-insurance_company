<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contracts;

/**
 * ContractsSearch represents the model behind the search form of `app\models\Contracts`.
 */
class ContractsSearch extends Contracts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'worker_id', 'filial_id', 'type_id', 'client_id', 'price'], 'integer'],
            [['date', 'date_expired'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Contracts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'worker_id' => $this->worker_id,
            'filial_id' => $this->filial_id,
            'type_id' => $this->type_id,
            'client_id' => $this->client_id,
            'price' => $this->price,
            'date' => $this->date,
            'date_expired' => $this->date_expired,
        ]);

        return $dataProvider;
    }
}
