<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sanciones".
 *
 * @property int $id
 * @property string $tipo
 * @property string $sansion
 * @property string $motivo
 * @property string $fecha
 *
 * @property CuadroSanciones[] $cuadroSanciones
 * @property Cuadro[] $cuadros
 */
class Sanciones extends \yii\db\ActiveRecord
{
    public $active = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sanciones';
    }
const SCENARIO_CREATE_SANCIONES = 'CSanciones';
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo', 'sansion', 'motivo', 'fecha'], 'required', 'on'=> self::SCENARIO_CREATE_SANCIONES],
            [['fecha'], 'safe'],
            [['tipo', 'sansion'], 'string', 'max' => 255],
            [['motivo'], 'string', 'max' => 1000],
            [['active'],'safe']
           ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo' => Yii::t('app', 'Tipo'),
            'sansion' => Yii::t('app', 'Sansion'),
            'motivo' => Yii::t('app', 'Motivo'),
            'fecha' => Yii::t('app', 'Fecha'),
            'active' => Yii::t('app', 'Sanciones'),
        ];
    }
   /* public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE_SANCIONES] = ['tipo_armaid', 'marca', 'modelo', 'no_licencia', 'tipo','cuadroid','id'];
      //  $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroSanciones()
    {
        return $this->hasMany(CuadroSanciones::className(), ['sancionesid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadros()
    {
        return $this->hasMany(Cuadro::className(), ['id' => 'cuadroid'])->viaTable('cuadro_sanciones', ['sancionesid' => 'id']);
    }
}
