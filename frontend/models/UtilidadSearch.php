<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Utilidad;

/**
 * UtilidadSearch represents the model behind the search form of `frontend\models\Utilidad`.
 */
class UtilidadSearch extends Utilidad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan', 'vreal'], 'number'],
            [['fecha', 'real_anterior', 'plan_anual', 'real_acum_plan', 'IPUI', 'IRUI', 'IPGI', 'IRGI'], 'safe'],
            [['id', 'empresaid', 'anexoid'], 'integer'],
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
        $query = Utilidad::find();

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
            'plan' => $this->plan,
            'vreal' => $this->vreal,
            'fecha' => $this->fecha,
            'id' => $this->id,
            'empresaid' => $this->empresaid,
            'anexoid' => $this->anexoid,
        ]);

        $query->andFilterWhere(['like', 'real_anterior', $this->real_anterior])
            ->andFilterWhere(['like', 'plan_anual', $this->plan_anual])
            ->andFilterWhere(['like', 'real_acum_plan', $this->real_acum_plan])
            ->andFilterWhere(['like', 'IPUI', $this->IPUI])
            ->andFilterWhere(['like', 'IRUI', $this->IRUI])
            ->andFilterWhere(['like', 'IPGI', $this->IPGI])
            ->andFilterWhere(['like', 'IRGI', $this->IRGI]);

        return $dataProvider;
    }
}
