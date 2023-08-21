<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\CentroEstudios;

/**
 * CentroEstudiosSearch represents the model behind the search form of `frontend\models\CentroEstudios`.
 */
class CentroEstudiosSearch extends CentroEstudios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'municipioid', 'provinciaid'], 'integer'],
            [['centro'], 'safe'],
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
        $query = CentroEstudios::find();

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
            'municipioid' => $this->municipioid,
            'provinciaid' => $this->provinciaid,
        ]);

        $query->andFilterWhere(['like', 'centro', $this->centro]);

        return $dataProvider;
    }
}
