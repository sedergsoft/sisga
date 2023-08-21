<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Direcciones;

/**
 * DireccionesSearch represents the model behind the search form of `frontend\models\Direcciones`.
 */
class DireccionesSearch extends Direcciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entre_calle_dos', 'provinciaid', 'municipioid'], 'integer'],
            [['calle', 'numero', 'edif', 'apto', 'piso', 'entre_calle_uno', 'Reparto'], 'safe'],
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
        $query = Direcciones::find();

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
            'entre_calle_dos' => $this->entre_calle_dos,
            'provinciaid' => $this->provinciaid,
            'municipioid' => $this->municipioid,
        ]);

        $query->andFilterWhere(['like', 'calle', $this->calle])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'edif', $this->edif])
            ->andFilterWhere(['like', 'apto', $this->apto])
            ->andFilterWhere(['like', 'piso', $this->piso])
            ->andFilterWhere(['like', 'entre_calle_uno', $this->entre_calle_uno])
            ->andFilterWhere(['like', 'Reparto', $this->Reparto]);

        return $dataProvider;
    }
}
