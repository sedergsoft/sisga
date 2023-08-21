<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Capital;

/**
 * CapitalSearch represents the model behind the search form of `frontend\models\Capital`.
 */
class CapitalSearch extends Capital
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'anexoid', 'empresaid'], 'integer'],
            [['activo_circulante', 'pasivo_circulante', 'creditos_bancarios'], 'number'],
            [['Suma', 'fecha'], 'safe'],
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
        $query = Capital::find();

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
            'anexoid' => $this->anexoid,
            'activo_circulante' => $this->activo_circulante,
            'pasivo_circulante' => $this->pasivo_circulante,
            'creditos_bancarios' => $this->creditos_bancarios,
            'empresaid' => $this->empresaid,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['like', 'Suma', $this->Suma]);

        return $dataProvider;
    }
}
