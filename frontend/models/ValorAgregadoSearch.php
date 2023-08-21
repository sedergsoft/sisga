<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ValorAgregado;

/**
 * ValorAgregadoSearch represents the model behind the search form of `frontend\models\ValorAgregado`.
 */
class ValorAgregadoSearch extends ValorAgregado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresaid', 'anexoid'], 'integer'],
            [['plan', 'vreal'], 'number'],
            [['fecha', 'plan_anterior'], 'safe'],
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
        $query = ValorAgregado::find();

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
            'fecha' => $this->fecha,
            'empresaid' => $this->empresaid,
            'anexoid' => $this->anexoid,
        ]);

        $query->andFilterWhere(['like', 'plan_anterior', $this->plan_anterior]);

        return $dataProvider;
    }
}
