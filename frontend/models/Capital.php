<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "capital".
 *
 * @property int $id
 * @property int $anexoid
 * @property double $activo_circulante
 * @property double $pasivo_circulante
 * @property string $Suma
 * @property double $creditos_bancarios
 * @property int $empresaid
 * @property string $fecha
 *
 * @property EvaluacionAnexo $anexo
 * @property Empresa $empresa
 */
class Capital extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'capital';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [/*
            [['id', 'anexoid', 'Suma', 'empresaid'], 'required'],
            [['id', 'anexoid', 'empresaid'], 'integer'],
            [['activo_circulante', 'pasivo_circulante', 'creditos_bancarios'], 'number'],
            [['fecha'], 'safe'],
            [['Suma'], 'string', 'max' => 25],
            [['id'], 'unique'],
            [['anexoid'], 'exist', 'skipOnError' => true, 'targetClass' => EvaluacionAnexo::className(), 'targetAttribute' => ['anexoid' => 'anexoid']],
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
            'anexoid' => Yii::t('app', 'Anexoid'),
            'activo_circulante' => Yii::t('app', 'Activo Circulante'),
            'pasivo_circulante' => Yii::t('app', 'Pasivo Circulante'),
            'Suma' => Yii::t('app', 'Suma'),
            'creditos_bancarios' => Yii::t('app', 'Creditos Bancarios'),
            'empresaid' => Yii::t('app', 'Empresaid'),
            'fecha' => Yii::t('app', 'Fecha'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnexo()
    {
        return $this->hasOne(EvaluacionAnexo::className(), ['anexoid' => 'anexoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresaid']);
    }
}
