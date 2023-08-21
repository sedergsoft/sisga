<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Ciclos;

/**
 * CiclosSearch represents the model behind the search form of `frontend\models\Ciclos`.
 */
class CiclosSearch extends Ciclos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CE', 'CEL', 'CELD', 'CPCE', 'CPCED', 'id', 'empresaid', 'anexoid'], 'integer'],
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
        $query = Ciclos::find();

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
            'CE' => $this->CE,
            'CEL' => $this->CEL,
            'CELD' => $this->CELD,
            'CPCE' => $this->CPCE,
            'CPCED' => $this->CPCED,
            'id' => $this->id,
            'empresaid' => $this->empresaid,
            'fecha' => $this->fecha,
            'anexoid' => $this->anexoid,
        ]);

        return $dataProvider;
    }
}
