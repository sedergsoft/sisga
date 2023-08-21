<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "variacion_gastos".
 *
 * @property int $id
 * @property int $empresaid
 * @property double $gastosxperdida
 * @property double $gastosxfaltante
 * @property string $fecha
 *  @property string $periodo
 * @property string $anexoid
 *
 * @property Empresa $empresa
 * @property Empresa $empresa0
 */
class VariacionGastos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variacion_gastos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
       return [
      /*      [['empresaid', 'fecha'], 'required'],
            [['empresaid'], 'integer'],
            [['gastosxperdida', 'gastosxfaltante'], 'number'],
            [['fecha'], 'safe'],
            [['anexoid'], 'string', 'max' => 255],
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
            'empresaid' => Yii::t('app', 'Empresa'),
            'gastosxperdida' => Yii::t('app', 'Gastos por perdida'),
            'gastosxfaltante' => Yii::t('app', 'Gastos por faltante'),
            'fecha' => Yii::t('app', 'Fecha'),
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
