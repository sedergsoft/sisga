<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\CumplimientoAnexo;

/**
 * CumplimientoAnexoSearch represents the model behind the search form of `frontend\models\CumplimientoAnexo`.
 */
class CumplimientoAnexoSearch extends CumplimientoAnexo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cumplimientoid', 'anexoid', 'idtabla', 'id'], 'integer'],
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
        $query = CumplimientoAnexo::find();

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
            'cumplimientoid' => $this->cumplimientoid,
            'anexoid' => $this->anexoid,
            'fecha' => $this->fecha,
            'idtabla' => $this->idtabla,
            'id' => $this->id,
        ]);

        return $dataProvider;
    }
}
