<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Sancionados;

/**
 * SancionadosSearch represents the model behind the search form of `frontend\models\Sancionados`.
 */
class SancionadosSearch extends Sancionados
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'familiarid'], 'integer'],
            [['sancion', 'fecha', 'motivo'], 'safe'],
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
        $query = Sancionados::find()->leftJoin('familiar','sancionados.familiarid=familiar.id')->leftJoin('cuadro_familiar','cuadro_familiar.familiarid=familiar.id');

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
            'familiarid' => $this->familiarid,
        ]);

        $query->andFilterWhere(['like', 'sancion', $this->sancion])
            ->andFilterWhere(['like', 'motivo', $this->motivo]);

        return $dataProvider;
    }
}
