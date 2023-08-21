<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MovimientoCuadro;

/**
 * MovimientoCuadroSearch represents the model behind the search form of `frontend\models\MovimientoCuadro`.
 */
class MovimientoCuadroSearch extends MovimientoCuadro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sintesis_biografica', 'resultados_controles', 'fundamentacion', 'consideraciones', 'entidad'], 'safe'],
            [['causas_sustitucion', 'idcargo_propuesto', 'tipo_movimientoid', 'cuadroid', 'cuadro_sustituido', 'evaluacion_cuadroid'], 'integer'],
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
        $query = MovimientoCuadro::find();

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
            'causas_sustitucion' => $this->causas_sustitucion,
            'idcargo_propuesto' => $this->idcargo_propuesto,
            'tipo_movimientoid' => $this->tipo_movimientoid,
            'cuadroid' => $this->cuadroid,
            'cuadro_sustituido' => $this->cuadro_sustituido,
            'evaluacion_cuadroid' => $this->evaluacion_cuadroid,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'sintesis_biografica', $this->sintesis_biografica])
            ->andFilterWhere(['like', 'resultados_controles', $this->resultados_controles])
            ->andFilterWhere(['like', 'fundamentacion', $this->fundamentacion])
            ->andFilterWhere(['like', 'consideraciones', $this->consideraciones])
            ->andFilterWhere(['like', 'entidad', $this->entidad]);

        return $dataProvider;
    }
}
