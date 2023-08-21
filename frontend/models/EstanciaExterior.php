<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "estancia_exterior".
 *
 * @property int $id
 * @property string $tipo
 * @property string $pais
 * @property string $fecha
 * @property string $cargo
 * @property string $motivo
 * @property int $cuadroid
 *
 * @property Cuadro $cuadro
 */
class EstanciaExterior extends \yii\db\ActiveRecord
{
  
     public $active = 0;
   
    const SCENARIO_CREATE_EXTANCIA = 'CExtancia';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estancia_exterior';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo', 'pais', 'fecha'], 'required', 'on'=> self::SCENARIO_CREATE_EXTANCIA],
            [['fecha'], 'safe'],
            [['cuadroid'], 'integer'],
            [['tipo', 'pais', 'cargo', 'motivo'], 'string', 'max' => 255],
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
            'tipo' => Yii::t('app', 'Tipo'),
            'pais' => Yii::t('app', 'Pais'),
            'fecha' => Yii::t('app', 'Fecha'),
            'cargo' => Yii::t('app', 'Cargo'),
            'motivo' => Yii::t('app', 'Motivo'),
            'cuadroid' => Yii::t('app', 'Cuadroid'),
            'active' => Yii::t('app', 'Estancia en el exterior'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadroid']);
    }
}
