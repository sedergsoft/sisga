<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Indicadoresgestion;

/**
 * IndicadoresgestionSearch represents the model behind the search form of `frontend\models\Indicadoresgestion`.
 */
class IndicadoresgestionSearch extends Indicadoresgestion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'fecha_chequeo', 'UM'], 'safe'],
            [['id', 'direccionid','status', 'topeid', 'orden', 'objetivoid','evaluado','editable'], 'integer'],
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
        $query = Indicadoresgestion::find();

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
            'fecha_chequeo' => $this->fecha_chequeo,
            'id' => $this->id,
            'direccionid' => $this->direccionid,
            'topeid' => $this->topeid,
            'orden' => $this->orden,
            'objetivoid' => $this->objetivoid,
            'editable'=> $this->editable,
              'status'=> $this->status,
            'evaluado' => $this->evaluado,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'UM', $this->UM]);

        return $dataProvider;
    }
}
