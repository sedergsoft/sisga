<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "informacion_laboratorios".
 *
 * @property int $id
 * @property int $empresaid
 * @property int $cant
 * @property int $terminados
 
 * @property int $cant_func
 * @property int $cant_no_func
 * @property string $fecha
 * @property int $anexoid
 *
 * @property Empresa $empresa
 */
class InformacionLaboratorios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informacion_laboratorios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [/*
            [['empresaid', 'cant', 'terminados',  'cant_func', 'cant_no_func', 'fecha', 'anexoid'], 'required'],
            [['empresaid', 'cant', 'terminados', 'cant_func', 'cant_no_func', 'anexoid'], 'integer'],
           
            [['fecha'], 'safe'],
            [['empresaid'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresaid' => 'id']],
       */ ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'empresaid' => Yii::t('app', 'Empresaid'),
            'cant' => Yii::t('app', 'Cant'),
            'terminados' => Yii::t('app', 'Terminados'),
           
            'cant_func' => Yii::t('app', 'Cant Func'),
            'cant_no_func' => Yii::t('app', 'Cant No Func'),
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
