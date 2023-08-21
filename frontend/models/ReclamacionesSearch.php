<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Reclamaciones;

/**
 * ReclamacionesSearch represents the model behind the search form of `frontend\models\Reclamaciones`.
 */
class ReclamacionesSearch extends Reclamaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cant_reclamacion', 'demanda_cant', 'anexoid', 'tipo_reclamacion', 'empresaid'], 'integer'],
            [['importe_reclamacion', 'demanda_importe', 'fecha'], 'safe'],
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
        $query = Reclamaciones::find();

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
            'cant_reclamacion' => $this->cant_reclamacion,
            'demanda_cant' => $this->demanda_cant,
            'anexoid' => $this->anexoid,
            'fecha' => $this->fecha,
            'tipo_reclamacion' => $this->tipo_reclamacion,
            'empresaid' => $this->empresaid,
        ]);

        $query->andFilterWhere(['like', 'importe_reclamacion', $this->importe_reclamacion])
            ->andFilterWhere(['like', 'demanda_importe', $this->demanda_importe]);

        return $dataProvider;
    }
}
