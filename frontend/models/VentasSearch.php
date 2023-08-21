<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Ventas;

/**
 * VentasSearch represents the model behind the search form of `frontend\models\Ventas`.
 */
class VentasSearch extends Ventas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'productoid', 'tipo_ventaid', 'empresaid'], 'integer'],
            [['plan', 'vreal'], 'number'],
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
        $query = Ventas::find();

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
            'plan' => $this->plan,
            'vreal' => $this->vreal,
            'productoid' => $this->productoid,
            'tipo_ventaid' => $this->tipo_ventaid,
            'empresaid' => $this->empresaid,
            'fecha' => $this->fecha,
        ]);

        return $dataProvider;
    }
}
