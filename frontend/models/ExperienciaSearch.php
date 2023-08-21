<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Experiencia;

/**
 * ExperienciaSearch represents the model behind the search form of `frontend\models\Experiencia`.
 */
class ExperienciaSearch extends Experiencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'años_cargo_actual', 'meses_cargo_actual', 'años_cuadro', 'meses_cuadro'], 'integer'],
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
        $query = Experiencia::find();

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
            'años_cargo_actual' => $this->años_cargo_actual,
            'meses_cargo_actual' => $this->meses_cargo_actual,
            'años_cuadro' => $this->años_cuadro,
            'meses_cuadro' => $this->meses_cuadro,
        ]);

        return $dataProvider;
    }
}
