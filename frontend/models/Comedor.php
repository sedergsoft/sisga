<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "comedor".
 *
 * @property int $id
 * @property double $gastos
 * @property double $ingresos
 * @property int $empresaid
 * @property string $fecha
 * @property int $anexoid
 *
 * @property Empresa $empresa
 */
class Comedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [/*
            [['gastos', 'ingresos'], 'number'],
            [['empresaid', 'anexoid'], 'required'],
            [['empresaid', 'anexoid'], 'integer'],
            [['fecha'], 'safe'],
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
            'gastos' => Yii::t('app', 'Gastos'),
            'ingresos' => Yii::t('app', 'Ingresos'),
            'empresaid' => Yii::t('app', 'Empresaid'),
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
}
