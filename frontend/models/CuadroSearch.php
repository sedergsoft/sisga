<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cuadro;

/**
 * CuadroSearch represents the model behind the search form of `frontend\models\Cuadro`.
 */
class CuadroSearch extends Cuadro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'preparacion_intelectualid', 'centro_trabajoid', 'cargoid', 'trayectoria_militarid', 'vehiculo', 'arma', 'ingresos_monetarios', 'beneficio_ingreso', 'reserva_cuadro', 'saludid'], 'integer'],
            [['personaCI', 'Lugar_nacimiento', 'ciudadania', 'color_piel', 'color_ojos', 'color_pelo', 'telefono', 'email', 'ubicacion_tiempo_guerra', 'foto'], 'safe'],
            [['estatura', 'peso'], 'number'],
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
        $query = Cuadro::find();

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
            'estatura' => $this->estatura,
            'peso' => $this->peso,
            'preparacion_intelectualid' => $this->preparacion_intelectualid,
            'centro_trabajoid' => $this->centro_trabajoid,
            'cargoid' => $this->cargoid,
            'trayectoria_militarid' => $this->trayectoria_militarid,
            'vehiculo' => $this->vehiculo,
            'arma' => $this->arma,
            'ingresos_monetarios' => $this->ingresos_monetarios,
            'beneficio_ingreso' => $this->beneficio_ingreso,
            'reserva_cuadro' => $this->reserva_cuadro,
            'saludid' => $this->saludid,
        ]);

        $query->andFilterWhere(['like', 'personaCI', $this->personaCI])
            ->andFilterWhere(['like', 'Lugar_nacimiento', $this->Lugar_nacimiento])
            ->andFilterWhere(['like', 'ciudadania', $this->ciudadania])
            ->andFilterWhere(['like', 'color_piel', $this->color_piel])
            ->andFilterWhere(['like', 'color_ojos', $this->color_ojos])
            ->andFilterWhere(['like', 'color_pelo', $this->color_pelo])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'ubicacion_tiempo_guerra', $this->ubicacion_tiempo_guerra])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
