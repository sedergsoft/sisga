<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "directivo".
 *
 * @property int $id
 * @property int $cuadroid
 * @property int $cargos_direccionid
 * @property int $años_cargo
 *
 * @property CargosDireccion $cargosDireccion
 * @property Cuadro $cuadro
 */
class Directivo extends \yii\db\ActiveRecord
{
     public $active = 0;
     const SCENARIO_CREATE_DIRECTIVO = 'CDirectivo';

   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'directivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'cargos_direccionid', 'años_cargo'], 'required','on'=> self::SCENARIO_CREATE_DIRECTIVO],
            [['cuadroid', 'cargos_direccionid', 'años_cargo'], 'integer'],
            [['cargos_direccionid'], 'exist', 'skipOnError' => true, 'targetClass' => CargosDireccion::className(), 'targetAttribute' => ['cargos_direccionid' => 'id']],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
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
            'cuadroid' => Yii::t('app', 'Cuadroid'),
            'cargos_direccionid' => Yii::t('app', 'Cargos de Direccion'),
            'años_cargo' => Yii::t('app', 'Años en Cargos de Dirección'),
            'active' => Yii::t('app', 'Trayectoria como directivo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargosDireccion()
    {
        return $this->hasOne(CargosDireccion::className(), ['id' => 'cargos_direccionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadroid']);
    }
}
