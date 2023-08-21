<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\VariacionGastos;

/**
 * VariacionGastosSearch represents the model behind the search form of `frontend\models\VariacionGastos`.
 */
class VariacionGastosSearch extends VariacionGastos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresaid'], 'integer'],
            [['gastosxperdida', 'gastosxfaltante'], 'number'],
            [['fecha', 'anexoid'], 'safe'],
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
        $query = VariacionGastos::find();

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
            'empresaid' => $this->empresaid,
            'gastosxperdida' => $this->gastosxperdida,
            'gastosxfaltante' => $this->gastosxfaltante,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['like', 'anexoid', $this->anexoid]);

        return $dataProvider;
    }
}
