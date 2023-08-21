<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "indicadores_gestion".
 *
 * @property string $descripcion
 * @property string $fecha_chequeo
 * @property int $id
 * @property int $direccionid
 * @property string $UM
 * @property int $topeid
 * @property int $orden
 * @property int $objetivoid
 * @property int $editable
 * @property int $status
 * @property int $evaluado
 * 
 * @property Direccion $direccion
 * @property Objetivo $objetivo
 * @property TopeIndicador $tope
 */
class IndicadoresGestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indicadores_gestion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['fecha_chequeo'], 'safe'],
            [['direccionid', 'topeid', 'objetivoid'], 'required'],
            [['status','direccionid', 'topeid', 'orden', 'objetivoid','editable'], 'integer'],
            [['UM'], 'string', 'max' => 255],
            [['direccionid'], 'exist', 'skipOnError' => true, 'targetClass' => Direccion::className(), 'targetAttribute' => ['direccionid' => 'id']],
            [['objetivoid'], 'exist', 'skipOnError' => true, 'targetClass' => Objetivo::className(), 'targetAttribute' => ['objetivoid' => 'id']],
            [['topeid'], 'exist', 'skipOnError' => true, 'targetClass' => TopeIndicador::className(), 'targetAttribute' => ['topeid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'descripcion' => Yii::t('app', 'Descripción'),
            'fecha_chequeo' => Yii::t('app', 'Fecha de Cierre'),
            'id' => Yii::t('app', 'ID'),
            'direccionid' => Yii::t('app', 'Direccion'),
            'UM' => Yii::t('app', 'U M'),
            'topeid' => Yii::t('app', 'Tope'),
            'orden' => Yii::t('app', 'No. de Orden'),
            'objetivoid' => Yii::t('app', 'Objetivo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireccion()
    {
        return $this->hasOne(Direccion::className(), ['id' => 'direccionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivo()
    {
        return $this->hasOne(Objetivo::className(), ['id' => 'objetivoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTope()
    {
        return $this->hasOne(TopeIndicador::className(), ['id' => 'topeid']);
    }
}
