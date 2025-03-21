<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\EstanciaExterior;

/**
 * EstanciaExteriorSearch represents the model behind the search form of `frontend\models\EstanciaExterior`.
 */
class EstanciaExteriorSearch extends EstanciaExterior
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'motivo', 'cuadroid'], 'integer'],
            [['tipo', 'pais', 'fecha', 'cargo'], 'safe'],
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
        $query = EstanciaExterior::find();

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
            'motivo' => $this->motivo,
            'cuadroid' => $this->cuadroid,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'cargo', $this->cargo]);

        return $dataProvider;
    }
}
