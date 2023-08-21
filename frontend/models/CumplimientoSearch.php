<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cumplimiento;

/**
 * CumplimientoSearch represents the model behind the search form of `frontend\models\Cumplimiento`.
 */
class CumplimientoSearch extends Cumplimiento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['indicadores_gestionid', 'userid', 'id', 'estado_cumplimientoid'], 'integer'],
            [['valor'], 'number'],
            [['observaciones'], 'safe'],
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
        $query = Cumplimiento::find();

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
            'indicadores_gestionid' => $this->indicadores_gestionid,
            'userid' => $this->userid,
            'id' => $this->id,
            'valor' => $this->valor,
            'estado_cumplimientoid' => $this->estado_cumplimientoid,
        ]);

        $query->andFilterWhere(['like', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
