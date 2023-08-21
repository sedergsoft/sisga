<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "valor_agregado".
 *
 * @property int $id
 * @property double $plan
 * @property double $vreal
 * @property string $fecha
 * @property int $empresaid
 * @property string $plan_anterior
 * @property int $anexoid
 *
 * @property Empresa $empresa
 * @property Empresa $empresa0
 */
class ValorAgregado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valor_agregado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           /* [['plan', 'vreal'], 'number'],
            [['fecha'], 'safe'],
            [['empresaid', 'plan_anterior', 'anexoid'], 'required'],
            [['empresaid', 'anexoid'], 'integer'],
            [['plan_anterior'], 'string', 'max' => 25],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
        */];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'plan' => Yii::t('app', 'Plan'),
            'vreal' => Yii::t('app', 'Vreal'),
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
