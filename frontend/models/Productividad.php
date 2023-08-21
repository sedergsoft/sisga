<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "productividad".
 *
 * @property double $plan
 * @property double $vreal
 * @property double $plan_anterior
 * @property string $fecha
 * @property double $correlacion
 * @property int $id
 * @property int $empresaid
 * @property int $anexoid
 *
 * @property Empresa $empresa
 * @property Empresa $empresa0
 */
class Productividad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productividad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [/*
            [['plan', 'vreal', 'plan_anterior', 'correlacion'], 'number'],
            [['fecha'], 'safe'],
            [['empresaid', 'anexoid'], 'required'],
            [['empresaid', 'anexoid'], 'integer'],
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
            'plan' => Yii::t('app', 'Plan'),
            'vreal' => Yii::t('app', 'Vreal'),
            'plan_anterior' => Yii::t('app', 'Plan Anterior'),
            'fecha' => Yii::t('app', 'Fecha'),
            'correlacion' => Yii::t('app', 'Correlacion'),
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
