<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TrayectoriaLaboral;

/**
 * TrayectoriaLaboralSearch represents the model behind the search form of `frontend\models\TrayectoriaLaboral`.
 */
class TrayectoriaLaboralSearch extends TrayectoriaLaboral
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cuadroid'], 'integer'],
            [['ocupacion', 'fecha_inicio', 'fecha_fin', 'motivo_cambio'], 'safe'],
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
        $query = TrayectoriaLaboral::find();

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
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'cuadroid' => $this->cuadroid,
            //'centro_trabajoid' => $this->centro_trabajoid,
        ]);

        $query->andFilterWhere(['like', 'ocupacion', $this->ocupacion])
            ->andFilterWhere(['like', 'motivo_cambio', $this->motivo_cambio]);

        return $dataProvider;
    }
}
