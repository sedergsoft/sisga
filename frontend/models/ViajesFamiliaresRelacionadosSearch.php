<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ViajesFamiliares;

/**
 * ViajesFamiliaresSearch represents the model behind the search form of `frontend\models\ViajesFamiliares`.
 */
class ViajesFamiliaresRelacionadosSearch extends ViajesFamiliares
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'familiarid'], 'integer'],
            [['fecha', 'pais'], 'safe'],
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
        $query = ViajesFamiliares::find()->leftJoin( 'cuadro_familiar','cuadro_familiar.familiarid = viajes_familiares.familiarid')->leftJoin( 'familiar','familiar.id = cuadro_familiar.familiarid');
        
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

        $query->andFilterWhere(['like', 'pais', $this->pais]);

        return $dataProvider;
    }
}
