<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\FamiliaresExterior;

/**
 * FamiliaresExteriorSearch represents the model behind the search form of `frontend\models\FamiliaresExterior`.
 */
class FamiliaresExteriorSearch extends FamiliaresExterior
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'familiarid'], 'integer'],
            [['pais', 'nacionalidad'], 'safe'],
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
        $query = FamiliaresExterior::find();
          $query = FamiliaresExterior::find()->leftJoin( 'familiar','familiar.id = familiares_exterior.familiarid')->leftJoin('cuadro_familiar','cuadro_familiar.familiarid=familiar.id');
      

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
            'familiarid' => $this->familiarid,
        ]);

        $query->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'nacionalidad', $this->nacionalidad]);

        return $dataProvider;
    }
}
