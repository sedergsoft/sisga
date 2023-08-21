<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\IngresosMonetarios;

/**
 * IngresosMonetariosSearch represents the model behind the search form of `frontend\models\IngresosMonetarios`.
 */
class IngresosMonetariosSearch extends IngresosMonetarios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tipo_familiarid', 'tipo_ingresosid'], 'integer'],
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
        $query = IngresosMonetarios::find()->leftJoin('cuadro_ingresos_monetarios', 'cuadro_ingresos_monetarios.ingresos_monetariosid=ingresos_monetarios.id');

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
            'tipo_familiarid' => $this->tipo_familiarid,
            'tipo_ingresosid' => $this->tipo_ingresosid,
        ]);

        return $dataProvider;
    }
}
