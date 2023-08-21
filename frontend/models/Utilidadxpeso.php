<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "utilidadxpeso".
 *
 * @property int $id
 * @property double $UPVA_vreal
 * @property double $UPVA_plan
 * @property string $fecha
 * @property int $empresaid
 * @property double $plan_anterior
 * @property int $anexoid
 *
 * @property Empresa $empresa
 * @property Empresa $empresa0
 */
class Utilidadxpeso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilidadxpeso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [/*
            [['UPVA_vreal', 'UPVA_plan', 'plan_anterior'], 'number'],
            [['fecha'], 'safe'],
            [['empresaid', 'plan_anterior', 'anexoid'], 'required'],
            [['empresaid', 'anexoid'], 'integer'],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
      */  ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'UPVA_vreal' => Yii::t('app', 'U P V A Vreal'),
            'UPVA_plan' => Yii::t('app', 'U P V A Plan'),
            'fecha' => Yii::t('app', 'Fecha'),
            'empresaid' => Yii::t('app', 'Empresaid'),
            'plan_anterior' => Yii::t('app', 'Plan Anterior'),
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
