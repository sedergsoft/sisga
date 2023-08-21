<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\EvaluacionCuadroIndicadoresEvaluacion;

/**
 * EvaluacionCuadroIndicadoresEvaluacionSearch represents the model behind the search form of `frontend\models\EvaluacionCuadroIndicadoresEvaluacion`.
 */
class EvaluacionCuadroIndicadoresEvaluacionSearch extends EvaluacionCuadroIndicadoresEvaluacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'evaluacion_cuadroid', 'Indicadores_evaluacionid'], 'integer'],
            [['evaluacion'], 'safe'],
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
        $query = EvaluacionCuadroIndicadoresEvaluacion::find();

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
            'evaluacion_cuadroid' => $this->evaluacion_cuadroid,
            'Indicadores_evaluacionid' => $this->Indicadores_evaluacionid,
        ]);

        $query->andFilterWhere(['like', 'evaluacion', $this->evaluacion]);

        return $dataProvider;
    }
}
