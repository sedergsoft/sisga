<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\FondoSalario;

/**
 * FondoSalarioSearch represents the model behind the search form of `frontend\models\FondoSalario`.
 */
class FondoSalarioSearch extends FondoSalario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FSVA_vreal', 'FSVA_plan', 'plan_anterior'], 'number'],
            [['fecha'], 'safe'],
            [['id', 'empresaid', 'anexoid'], 'integer'],
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
        $query = FondoSalario::find();

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
            'FSVA_vreal' => $this->FSVA_vreal,
            'FSVA_plan' => $this->FSVA_plan,
            'fecha' => $this->fecha,
            'id' => $this->id,
            'empresaid' => $this->empresaid,
            'plan_anterior' => $this->plan_anterior,
            'anexoid' => $this->anexoid,
        ]);

        return $dataProvider;
    }
}
