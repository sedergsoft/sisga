<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Criteriomedida;

/**
 * CriteriomedidaSearch represents the model behind the search form of `frontend\models\Criteriomedida`.
 */
class CriteriomedidaSearch extends Criteriomedida
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'orden', 'status',  'editable','evaluado'], 'integer'],
            [['Descripcion', 'Objetivoid', 'direccionid', 'topeid','UM'], 'safe'],
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
        $query = Criteriomedida::find();

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
            'orden' => $this->orden,
            'status' => $this->status,
            'Objetivoid' => $this->Objetivoid,
            'direccionid' => $this->direccionid,
            'topeid' => $this->topeid,
             'editable'=> $this->editable,
            'evaluado' => $this->evaluado,
        ]);

        $query->andFilterWhere(['like', 'Descripcion', $this->Descripcion])
            ->andFilterWhere(['like', 'UM', $this->UM]);

        return $dataProvider;
    }
}
