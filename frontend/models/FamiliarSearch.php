<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Familiar;

/**
 * FamiliarSearch represents the model behind the search form of `frontend\models\Familiar`.
 */
class FamiliarSearch extends Familiar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'centro_estudio_trabajo', 'conviviente', 'sancionado'], 'integer'],
            [['tipo_familiar', 'personaCI'], 'safe'],
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
        $query = Familiar::find();

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
            'centro_estudio_trabajo' => $this->centro_estudio_trabajo,
            'conviviente' => $this->conviviente,
            'sancionado' => $this->sancionado,
        ]);

        $query->andFilterWhere(['like', 'tipo_familiar', $this->tipo_familiar])
            ->andFilterWhere(['like', 'personaCI', $this->personaCI]);

        return $dataProvider;
    }
}
