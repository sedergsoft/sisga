<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\LimitacionesSalud;

/**
 * LimitacionesSaludSearch represents the model behind the search form of `frontend\models\LimitacionesSalud`.
 */
class LimitacionesSaludSearch extends LimitacionesSalud
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['limitacionesid', 'saludid'], 'integer'],
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
        $query = LimitacionesSalud::find();

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
            'limitacionesid' => $this->limitacionesid,
            'saludid' => $this->saludid,
        ]);

        return $dataProvider;
    }
}
