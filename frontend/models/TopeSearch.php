<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Tope;

/**
 * TopeSearch represents the model behind the search form of `frontend\models\Tope`.
 */
class TopeSearch extends Tope
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['Itrimestre', 'IItrimestre', 'IIItrimestre', 'IVtrimestre'], 'number'],
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
        $query = Tope::find();

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
            'Itrimestre' => $this->Itrimestre,
            'IItrimestre' => $this->IItrimestre,
            'IIItrimestre' => $this->IIItrimestre,
            'IVtrimestre' => $this->IVtrimestre,
        ]);

        return $dataProvider;
    }
}
