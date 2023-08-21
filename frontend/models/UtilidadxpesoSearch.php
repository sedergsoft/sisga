<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Utilidadxpeso;

/**
 * UtilidadxpesoSearch represents the model behind the search form of `frontend\models\Utilidadxpeso`.
 */
class UtilidadxpesoSearch extends Utilidadxpeso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresaid', 'anexoid'], 'integer'],
            [['UPVA_vreal', 'UPVA_plan', 'plan_anterior'], 'number'],
            [['fecha'], 'safe'],
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
        $query = Utilidadxpeso::find();

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
            'UPVA_vreal' => $this->UPVA_vreal,
            'UPVA_plan' => $this->UPVA_plan,
            'fecha' => $this->fecha,
            'empresaid' => $this->empresaid,
            'plan_anterior' => $this->plan_anterior,
            'anexoid' => $this->anexoid,
        ]);

        return $dataProvider;
    }
}
