<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\InformacionLaboratorios;

/**
 * InformacionLaboratoriosSearch represents the model behind the search form of `frontend\models\InformacionLaboratorios`.
 */
class InformacionLaboratoriosSearch extends InformacionLaboratorios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresaid', 'cant', 'terminados', 'cant_func', 'cant_no_func', 'anexoid'], 'integer'],
            
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
        $query = InformacionLaboratorios::find();

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
            'empresaid' => $this->empresaid,
            'cant' => $this->cant,
            'terminados' => $this->terminados,
       
            'cant_func' => $this->cant_func,
            'cant_no_func' => $this->cant_no_func,
            'fecha' => $this->fecha,
            'anexoid' => $this->anexoid,
        ]);

        return $dataProvider;
    }
}
