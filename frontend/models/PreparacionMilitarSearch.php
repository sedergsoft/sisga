<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PreparacionMilitar;

/**
 * PreparacionMilitarSearch represents the model behind the search form of `frontend\models\PreparacionMilitar`.
 */
class PreparacionMilitarSearch extends PreparacionMilitar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trayectoria_militarid'], 'integer'],
            [['escuela', 'curso', 'fecha'], 'safe'],
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
        $query = PreparacionMilitar::find();

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
            'fecha' => $this->fecha,
            'trayectoria_militarid' => $this->trayectoria_militarid,
        ]);

        $query->andFilterWhere(['like', 'escuela', $this->escuela])
            ->andFilterWhere(['like', 'curso', $this->curso]);

        return $dataProvider;
    }
}
