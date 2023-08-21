<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ControlUsuario;

/**
 * ControlUsuarioSearch represents the model behind the search form of `frontend\models\ControlUsuario`.
 */
class ControlUsuarioSearch extends ControlUsuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'userid'], 'integer'],
            [['preg_1', 'preg_2', 'preg_3', 'preg_4', 'preg_5', 'resp_1', 'resp_2', 'resp_3', 'resp_4', 'resp_5'], 'safe'],
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
        $query = ControlUsuario::find();

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
            'userid' => $this->userid,
        ]);

        $query->andFilterWhere(['like', 'preg_1', $this->preg_1])
            ->andFilterWhere(['like', 'preg_2', $this->preg_2])
            ->andFilterWhere(['like', 'preg_3', $this->preg_3])
            ->andFilterWhere(['like', 'preg_4', $this->preg_4])
            ->andFilterWhere(['like', 'preg_5', $this->preg_5])
            ->andFilterWhere(['like', 'resp_1', $this->resp_1])
            ->andFilterWhere(['like', 'resp_2', $this->resp_2])
            ->andFilterWhere(['like', 'resp_3', $this->resp_3])
            ->andFilterWhere(['like', 'resp_4', $this->resp_4])
            ->andFilterWhere(['like', 'resp_5', $this->resp_5]);

        return $dataProvider;
    }
}
