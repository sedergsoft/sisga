<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cuentas;

/**
 * CuentasSearch represents the model behind the search form of `frontend\models\Cuentas`.
 */
class CuentasSearch extends Cuentas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['representatividad', 'total_cuentas_vencidas', 'saldo_sentencias_judiciales', 'cxc_litigio', 'nm_no_vencida', 'efectos', 'mn_total_vencida', 'ExC_litigio', 'ventas_acumuladas', 'efectiviadad'], 'number'],
            [['id', 'no_vencidas', 'empresaid', 'tipo_cuentaid', 'vencidas', 'anexoid'], 'integer'],
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
        $query = Cuentas::find();

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
            'representatividad' => $this->representatividad,
            'id' => $this->id,
            'total_cuentas_vencidas' => $this->total_cuentas_vencidas,
            'no_vencidas' => $this->no_vencidas,
            'saldo_sentencias_judiciales' => $this->saldo_sentencias_judiciales,
            'empresaid' => $this->empresaid,
            'cxc_litigio' => $this->cxc_litigio,
            'nm_no_vencida' => $this->nm_no_vencida,
            'efectos' => $this->efectos,
            'mn_total_vencida' => $this->mn_total_vencida,
            'ExC_litigio' => $this->ExC_litigio,
            'ventas_acumuladas' => $this->ventas_acumuladas,
            'fecha' => $this->fecha,
            'tipo_cuentaid' => $this->tipo_cuentaid,
            'efectiviadad' => $this->efectiviadad,
            'vencidas' => $this->vencidas,
            'anexoid' => $this->anexoid,
        ]);

        return $dataProvider;
    }
}
