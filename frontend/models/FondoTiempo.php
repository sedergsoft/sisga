<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "fondo_tiempo".
 *
 * @property int $adiestrado
 * @property double $indice_utilizacion
 * @property double $indice_ausentismo
 * @property double $ausentismo_puro
 * @property int $promedio_trab_mensual
 * @property string $fecha
 * @property int $id
 * @property int $empresaid
 * @property int $anexoid
 *
 * @property Empresa $empresa
 * @property Empresa $empresa0
 */
class FondoTiempo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fondo_tiempo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [/*
            [['adiestrado', 'promedio_trab_mensual', 'empresaid', 'anexoid'], 'integer'],
            [['indice_utilizacion', 'indice_ausentismo', 'ausentismo_puro'], 'number'],
            [['fecha'], 'safe'],
            [['empresaid', 'anexoid'], 'required'],
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
            'adiestrado' => Yii::t('app', 'Adiestrado'),
            'indice_utilizacion' => Yii::t('app', 'Indice Utilizacion'),
            'indice_ausentismo' => Yii::t('app', 'Indice Ausentismo'),
            'ausentismo_puro' => Yii::t('app', 'Ausentismo Puro'),
            'promedio_trab_mensual' => Yii::t('app', 'Promedio Trab Mensual'),
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
