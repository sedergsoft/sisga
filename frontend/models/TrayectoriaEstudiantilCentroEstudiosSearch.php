<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TrayectoriaEstudiantilCentroEstudios;

/**
 * TrayectoriaEstudiantilCentroEstudiosSearch represents the model behind the search form of `frontend\models\TrayectoriaEstudiantilCentroEstudios`.
 */
class TrayectoriaEstudiantilCentroEstudiosSearch extends TrayectoriaEstudiantilCentroEstudios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trayectoria_estudiantilid', 'centro_estudiosid'], 'integer'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
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
        $query = TrayectoriaEstudiantilCentroEstudios::find()->leftJoin('trayectoria_estudiantil', 'trayectoria_estudiantil.id = trayectoria_estudiantil_centro_estudios.trayectoria_estudiantilid');

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
            'trayectoria_estudiantilid' => $this->trayectoria_estudiantilid,
            'centro_estudiosid' => $this->centro_estudiosid,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
        ]);

        return $dataProvider;
    }
}
