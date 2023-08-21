<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "impuesto".
 *
 * @property double $venta35_plan
 * @property double $ventas35_vreal
 * @property double $ventas2_plan
 * @property double $ventas2_vreal
 * @property double $especial17_vreal
 * @property double $especial17_real2
 * @property double $recupercion_vreal
 * @property int $recuperacion_plan
 * @property string $fecha
 * @property int $id
 * @property int $empresaid
 * @property int $anexoid
 *
 * @property Empresa $empresa
 * @property Empresa $empresa0
 */
class Impuesto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'impuesto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [/*
            [['venta35_plan', 'ventas35_vreal', 'ventas2_plan', 'ventas2_vreal', 'especial17_vreal', 'especial17_real2', 'recupercion_vreal'], 'number'],
            [['recuperacion_plan', 'empresaid', 'anexoid'], 'integer'],
            [['fecha'], 'safe'],
            [['empresaid', 'anexoid'], 'required'],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
       */ ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'venta35_plan' => Yii::t('app', 'Venta35 Plan'),
            'ventas35_vreal' => Yii::t('app', 'Ventas35 Vreal'),
            'ventas2_plan' => Yii::t('app', 'Ventas2 Plan'),
            'ventas2_vreal' => Yii::t('app', 'Ventas2 Vreal'),
            'especial17_vreal' => Yii::t('app', 'Especial17 Vreal'),
            'especial17_real2' => Yii::t('app', 'Especial17 Real2'),
            'recupercion_vreal' => Yii::t('app', 'Recupercion Vreal'),
            'recuperacion_plan' => Yii::t('app', 'Recuperacion Plan'),
            'fecha' => Yii::t('app', 'Fecha'),
            'id' => Yii::t('app', 'ID'),
            'empresaid' => Yii::t('app', 'Empresaid'),
            'anexoid' => Yii::t('app', 'Anexoid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa0()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresaid']);
    }
}
