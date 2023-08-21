<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PreparacionIntelectual;

/**
 * PreparacionIntelectualSearch represents the model behind the search form of `frontend\models\PreparacionIntelectual`.
 */
class PreparacionIntelectualSearch extends PreparacionIntelectual
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'informatica'], 'integer'],
            [['nivel_escolaridad', 'Especialidad', 'grado_cientifico', 'categoria_docente'], 'safe'],
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
        $query = PreparacionIntelectual::find();

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
            'informatica' => $this->informatica,
        ]);

        $query->andFilterWhere(['like', 'nivel_escolaridad', $this->nivel_escolaridad])
            ->andFilterWhere(['like', 'Especialidad', $this->Especialidad])
            ->andFilterWhere(['like', 'grado_cientifico', $this->grado_cientifico])
            ->andFilterWhere(['like', 'categoria_docente', $this->categoria_docente]);

        return $dataProvider;
    }
}
