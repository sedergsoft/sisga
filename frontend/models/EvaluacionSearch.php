<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Evaluacion;

/**
 * EvaluacionSearch represents the model behind the search form of `frontend\models\Evaluacion`.
 */
class EvaluacionSearch extends Evaluacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'direccionid', 'criteriomedidaid', 'estado', 'periodo', 'userid', 'status'], 'integer'],
            [['valor_vreal'], 'number'],
            [['fechacreado', 'observaciones'], 'safe'],
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
        $query = Evaluacion::find();

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
            'valor_vreal' => $this->valor_vreal,
            'fechacreado' => $this->fechacreado,
            'direccionid' => $this->direccionid,
            'criteriomedidaid' => $this->criteriomedidaid,
            'estado' => $this->estado,
            'periodo' => $this->periodo,
            'userid' => $this->userid,
            'status'=> $this->status,
        ]);

        $query->andFilterWhere(['like', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
