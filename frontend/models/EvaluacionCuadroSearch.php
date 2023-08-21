<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\EvaluacionCuadro;

/**
 * EvaluacionCuadroSearch represents the model behind the search form of `frontend\models\EvaluacionCuadro`.
 */
class EvaluacionCuadroSearch extends EvaluacionCuadro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cuadroid', 'reservaid', 'proyeccionid', 'opinion_evaluadoid', 'experienciaid', 'periodo_evaluadoid', 'organismoidorganismo'], 'integer'],
            [['complemento_textual', 'señalamientos', 'concluciones', 'resultado_evaluacion', 'superacion', 'confecionado', 'entidad'], 'safe'],
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
        $query = EvaluacionCuadro::find();

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
            'cuadroid' => $this->cuadroid,
            'reservaid' => $this->reservaid,
            'proyeccionid' => $this->proyeccionid,
            'opinion_evaluadoid' => $this->opinion_evaluadoid,
            'experienciaid' => $this->experienciaid,
            'periodo_evaluadoid' => $this->periodo_evaluadoid,
            'organismoidorganismo' => $this->organismoidorganismo,
        ]);

        $query->andFilterWhere(['like', 'complemento_textual', $this->complemento_textual])
            ->andFilterWhere(['like', 'señalamientos', $this->señalamientos])
            ->andFilterWhere(['like', 'concluciones', $this->concluciones])
            ->andFilterWhere(['like', 'resultado_evaluacion', $this->resultado_evaluacion])
            ->andFilterWhere(['like', 'superacion', $this->superacion])
            ->andFilterWhere(['like', 'confecionado', $this->confecionado])
            ->andFilterWhere(['like', 'entidad', $this->entidad]);

        return $dataProvider;
    }
}
