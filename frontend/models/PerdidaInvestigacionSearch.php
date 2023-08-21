<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PerdidaInvestigacion;

/**
 * PerdidaInvestigacionSearch represents the model behind the search form of `frontend\models\PerdidaInvestigacion`.
 */
class PerdidaInvestigacionSearch extends PerdidaInvestigacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cant_expedientas', 'fuera_termino', 'tipo_expedienteid', 'empresaid'], 'integer'],
            [['importe_total', 'valor_fuera_termino'], 'number'],
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
        $query = PerdidaInvestigacion::find();

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
            'importe_total' => $this->importe_total,
            'cant_expedientas' => $this->cant_expedientas,
            'fuera_termino' => $this->fuera_termino,
            'valor_fuera_termino' => $this->valor_fuera_termino,
            'tipo_expedienteid' => $this->tipo_expedienteid,
            'empresaid' => $this->empresaid,
            'fecha' => $this->fecha,
        ]);

        return $dataProvider;
    }
}
