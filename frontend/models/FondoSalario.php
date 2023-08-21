<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "fondo_salario".
 *
 * @property double $FSVA_vreal
 * @property double $FSVA_plan
 * @property string $fecha
 * @property int $id
 * @property int $empresaid
 * @property double $plan_anterior
 * @property int $anexoid
 *
 * @property Empresa $empresa
 */
class FondoSalario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fondo_salario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           /* [['FSVA_vreal', 'FSVA_plan', 'plan_anterior'], 'number'],
            [['fecha'], 'safe'],
            [['empresaid', 'plan_anterior', 'anexoid'], 'required'],
            [['empresaid', 'anexoid'], 'integer'],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
       */ ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FSVA_vreal' => Yii::t('app', 'F S V A Vreal'),
            'FSVA_plan' => Yii::t('app', 'F S V A Plan'),
            'fecha' => Yii::t('app', 'Fecha'),
            'id' => Yii::t('app', 'ID'),
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
}
