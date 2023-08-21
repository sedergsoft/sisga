<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\FondoTiempo;

/**
 * FondoTiempoSearch represents the model behind the search form of `frontend\models\FondoTiempo`.
 */
class FondoTiempoSearch extends FondoTiempo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adiestrado', 'promedio_trab_mensual', 'id', 'empresaid', 'anexoid'], 'integer'],
            [['indice_utilizacion', 'indice_ausentismo', 'ausentismo_puro'], 'number'],
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
        $query = FondoTiempo::find();

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
            'adiestrado' => $this->adiestrado,
            'indice_utilizacion' => $this->indice_utilizacion,
            'indice_ausentismo' => $this->indice_ausentismo,
            'ausentismo_puro' => $this->ausentismo_puro,
            'promedio_trab_mensual' => $this->promedio_trab_mensual,
            'fecha' => $this->fecha,
            'id' => $this->id,
            'empresaid' => $this->empresaid,
            'anexoid' => $this->anexoid,
        ]);

        return $dataProvider;
    }
}
