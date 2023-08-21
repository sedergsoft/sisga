<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TrayectoriaMilitarMilitancia;

/**
 * TrayectoriaMilitarMilitanciaSearch represents the model behind the search form of `frontend\models\TrayectoriaMilitarMilitancia`.
 */
class TrayectoriaMilitarMilitanciaSearch extends TrayectoriaMilitarMilitancia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trayectoria_militarid', 'militanciaid'], 'integer'],
            [['fecha_entrada', 'fecha_baja', 'causa_baja'], 'safe'],
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
        $query = TrayectoriaMilitarMilitancia::find();

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
            'trayectoria_militarid' => $this->trayectoria_militarid,
            'militanciaid' => $this->militanciaid,
            'fecha_entrada' => $this->fecha_entrada,
            'fecha_baja' => $this->fecha_baja,
        ]);

        $query->andFilterWhere(['like', 'causa_baja', $this->causa_baja]);

        return $dataProvider;
    }
}
