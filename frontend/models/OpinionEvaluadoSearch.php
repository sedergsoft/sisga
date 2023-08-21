<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\OpinionEvaluado;

/**
 * OpinionEvaluadoSearch represents the model behind the search form of `frontend\models\OpinionEvaluado`.
 */
class OpinionEvaluadoSearch extends OpinionEvaluado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reclamacion'], 'integer'],
            [['opinion', 'reclamacion_desc'], 'safe'],
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
        $query = OpinionEvaluado::find();

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
            'reclamacion' => $this->reclamacion,
        ]);

        $query->andFilterWhere(['like', 'opinion', $this->opinion])
            ->andFilterWhere(['like', 'reclamacion_desc', $this->reclamacion_desc]);

        return $dataProvider;
    }
}
