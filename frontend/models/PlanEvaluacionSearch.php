<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PlanEvaluacion;

/**
 * PlanEvaluacionSearch represents the model behind the search form of `frontend\models\PlanEvaluacion`.
 */
class PlanEvaluacionSearch extends PlanEvaluacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idevaluador', 'idcuadro', 'status', 'observaciones'], 'integer'],
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
        $query = PlanEvaluacion::find()->leftJoin('cuadro','cuadro.id = plan_evaluacion.idcuadro');

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
            'idevaluador' => $this->idevaluador,
            'idcuadro' => $this->idcuadro,
            'fecha' => $this->fecha,
            'plan_evaluacion.status' => $this->status,
            'observaciones' => $this->observaciones,
        ]);

        return $dataProvider;
    }
}
