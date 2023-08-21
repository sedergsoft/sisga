<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\CuadroEscuelaPolitica;

/**
 * CuadroEscuelaPoliticaSearch represents the model behind the search form of `frontend\models\CuadroEscuelaPolitica`.
 */
class CuadroEscuelaPoliticaSearch extends CuadroEscuelaPolitica
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cuadroid', 'escuela_politicaid'], 'integer'],
            [['curso', 'fecha'], 'safe'],
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
        $query = CuadroEscuelaPolitica::find();

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
            'cuadroid' => $this->cuadroid,
            'escuela_politicaid' => $this->escuela_politicaid,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['like', 'curso', $this->curso]);

        return $dataProvider;
    }
}
