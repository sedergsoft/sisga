<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\EvaluacionAnexo;

/**
 * EvaluacionAnexoSearch represents the model behind the search form of `frontend\models\EvaluacionAnexo`.
 */
class EvaluacionAnexoSearch extends EvaluacionAnexo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['evaluacionid', 'anexoid', 'idtabla', 'id'], 'integer'],
            [['fecha', 'anexo'], 'safe'],
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
        $query = EvaluacionAnexo::find();

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
            'evaluacionid' => $this->evaluacionid,
            'anexoid' => $this->anexoid,
            'fecha' => $this->fecha,
            'idtabla' => $this->idtabla,
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'anexo', $this->anexo]);

        return $dataProvider;
    }
}
