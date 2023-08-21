<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "utilidad".
 *
 * @property double $plan
 * @property double $vreal
 * @property string $fecha
 * @property int $id
 * @property int $empresaid
 * @property string $real_anterior
 * @property string $plan_anual
 * @property string $real_acum_plan
 * @property string $IPUI
 * @property string $IRUI
 * @property string $IPGI
 * @property string $IRGI
 * @property int $anexoid
 *
 * @property Empresa $empresa
 * @property Empresa $empresa0
 */
class Utilidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [/*
            [['plan', 'vreal'], 'number'],
            [['fecha'], 'safe'],
            [['empresaid', 'real_anterior', 'plan_anual', 'real_acum_plan', 'IPUI', 'IRUI', 'IPGI', 'IRGI', 'anexoid'], 'required'],
            [['empresaid', 'anexoid'], 'integer'],
            [['real_anterior', 'plan_anual', 'real_acum_plan', 'IPUI', 'IRUI', 'IPGI', 'IRGI'], 'string', 'max' => 25],
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
            'fecha' => Yii::t('app', 'Fecha'),
            'id' => Yii::t('app', 'ID'),
            'empresaid' => Yii::t('app', 'Empresaid'),
            'real_anterior' => Yii::t('app', 'Real Anterior'),
            'plan_anual' => Yii::t('app', 'Plan Anual'),
            'real_acum_plan' => Yii::t('app', 'Real Acum Plan'),
            'IPUI' => Yii::t('app', 'I P U I'),
            'IRUI' => Yii::t('app', 'I R U I'),
            'IPGI' => Yii::t('app', 'I P G I'),
            'IRGI' => Yii::t('app', 'I R G I'),
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
