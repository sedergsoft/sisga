<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Trazas;

/**
 * TrazasSearch represents the model behind the search form of `frontend\models\Trazas`.
 */
class TrazasSearch extends Trazas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdTraza'], 'integer'],
            [['tarea_realizada', 'IdUsuario', 'Tabla_Afectada', 'fecha', 'hora', 'valor_antiguo', 'valor_actual'], 'safe'],
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
        $query = Trazas::find();

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
        $query->joinWith('usuario');

        // grid filtering conditions
        $query->andFilterWhere([
            'IdTraza' => $this->IdTraza,
         
            'fecha' => $this->fecha,
            'hora' => $this->hora,
        ]);

        $query->andFilterWhere(['like', 'tarea_realizada', $this->tarea_realizada])
            ->andFilterWhere(['like', 'Tabla_Afectada', $this->Tabla_Afectada])
            ->andFilterWhere(['like', 'valor_antiguo', $this->valor_antiguo])
            ->andFilterWhere(['like', 'valor_actual', $this->valor_actual])
            ->andFilterWhere(['like', 'user.username', $this->IdUsuario]);

        return $dataProvider;
    }
}
