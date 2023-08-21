<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Impuesto;

/**
 * ImpuestoSearch represents the model behind the search form of `frontend\models\Impuesto`.
 */
class ImpuestoSearch extends Impuesto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['venta35_plan', 'ventas35_vreal', 'ventas2_plan', 'ventas2_vreal', 'especial17_vreal', 'especial17_real2', 'recupercion_vreal'], 'number'],
            [['recuperacion_plan', 'id', 'empresaid', 'anexoid'], 'integer'],
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
        $query = Impuesto::find();

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
            'venta35_plan' => $this->venta35_plan,
            'ventas35_vreal' => $this->ventas35_vreal,
            'ventas2_plan' => $this->ventas2_plan,
            'ventas2_vreal' => $this->ventas2_vreal,
            'especial17_vreal' => $this->especial17_vreal,
            'especial17_real2' => $this->especial17_real2,
            'recupercion_vreal' => $this->recupercion_vreal,
            'recuperacion_plan' => $this->recuperacion_plan,
            'fecha' => $this->fecha,
            'id' => $this->id,
            'empresaid' => $this->empresaid,
            'anexoid' => $this->anexoid,
        ]);

        return $dataProvider;
    }
}
