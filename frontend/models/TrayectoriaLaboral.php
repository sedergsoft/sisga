<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trayectoria_laboral".
 *
 * @property int $id
 * @property string $ocupacion
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $motivo_cambio
 * @property int $cuadroid
 * @property string $centro_trabajo
 *
 * @property Cuadro $cuadro

 */
class TrayectoriaLaboral extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trayectoria_laboral';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ocupacion', 'fecha_inicio', 'centro_trabajo'], 'required'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['cuadroid'], 'integer'],
            [['ocupacion', 'centro_trabajo'], 'string', 'max' => 255],
            [['motivo_cambio'], 'string', 'max' => 1000],
            //[['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
           ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ocupacion' => Yii::t('app', 'Ocupacion'),
            'fecha_inicio' => Yii::t('app', 'Fecha de Inicio'),
            'fecha_fin' => Yii::t('app', 'Fecha de Fin'),
            'motivo_cambio' => Yii::t('app', 'Motivo del Cambio'),
            'cuadroid' => Yii::t('app', 'Cuadroid'),
            'centro_trabajo' => Yii::t('app', 'Centro Laboral'),
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
  
}
