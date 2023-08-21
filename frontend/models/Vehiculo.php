<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vehiculo".
 *
 * @property int $id
 * @property int $tipo_vehiculoid
 * @property string $modelo
 * @property string $marca
 * @property string $matricula
 * @property int $cuadroid
 *
 * @property Cuadro $cuadro
 * @property TipoVehiculo $tipoVehiculo
 */
class Vehiculo extends \yii\db\ActiveRecord
{
    public $active = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehiculo';
    }
const SCENARIO_CREATE_VEHICULO = 'CVehiculo';
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_vehiculoid', 'modelo', 'marca', 'matricula'], 'required','on'=> self::SCENARIO_CREATE_VEHICULO],
            [['tipo_vehiculoid', 'cuadroid'], 'integer'],
            [['modelo', 'marca', 'matricula'], 'string', 'max' => 255],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
            [['tipo_vehiculoid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoVehiculo::className(), 'targetAttribute' => ['tipo_vehiculoid' => 'id']],
            [['active'],'safe']
            ];
    }

    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE_VEHICULO] = ['tipo_vehiculoid', 'modelo', 'marca', 'matricula','cuadroid'];
      //  $scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_vehiculoid' => Yii::t('app', 'Tipo de Vehiculo'),
            'modelo' => Yii::t('app', 'Modelo'),
            'marca' => Yii::t('app', 'Marca'),
            'matricula' => Yii::t('app', 'Matricula'),
            'cuadroid' => Yii::t('app', 'Cuadro'),
            'active' => Yii::t('app', 'Vehículo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadroid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoVehiculo()
    {
        return $this->hasOne(TipoVehiculo::className(), ['id' => 'tipo_vehiculoid']);
    }
}
