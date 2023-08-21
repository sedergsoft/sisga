<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Comedor;

/**
 * ComedorSearch represents the model behind the search form of `frontend\models\Comedor`.
 */
class ComedorSearch extends Comedor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresaid', 'anexoid'], 'integer'],
            [['gastos', 'ingresos'], 'number'],
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
        $query = Comedor::find();

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
            'gastos' => $this->gastos,
            'ingresos' => $this->ingresos,
            'empresaid' => $this->empresaid,
            'fecha' => $this->fecha,
            'anexoid' => $this->anexoid,
        ]);

        return $dataProvider;
    }
}
