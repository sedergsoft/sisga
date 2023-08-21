<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Productividad;

/**
 * ProductividadSearch represents the model behind the search form of `frontend\models\Productividad`.
 */
class ProductividadSearch extends Productividad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan', 'vreal', 'plan_anterior', 'correlacion'], 'number'],
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
        $query = Productividad::find();

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
            'plan' => $this->plan,
            'vreal' => $this->vreal,
            'plan_anterior' => $this->plan_anterior,
            'fecha' => $this->fecha,
            'correlacion' => $this->correlacion,
            'id' => $this->id,
            'empresaid' => $this->empresaid,
            'anexoid' => $this->anexoid,
        ]);

        return $dataProvider;
    }
}
