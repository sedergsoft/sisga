<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reclamaciones".
 *
 * @property int $id
 * @property int $cant_reclamacion
 * @property string $importe_reclamacion
 * @property int $demanda_cant
 * @property string $demanda_importe
 * @property int $anexoid
 * @property string $fecha
 * @property int $tipo_reclamacion
 * @property int $empresaid
 *
 * @property TipoRelcamacion $tipoReclamacion
 */
class Reclamaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reclamaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [/*
            [['cant_reclamacion', 'demanda_cant', 'anexoid', 'tipo_reclamacion', 'empresaid'], 'integer'],
            [['fecha'], 'safe'],
            [['tipo_reclamacion', 'empresaid'], 'required'],
            [['importe_reclamacion', 'demanda_importe'], 'string', 'max' => 25],
            [['tipo_reclamacion'], 'exist', 'skipOnError' => true, 'targetClass' => TipoRelcamacion::className(), 'targetAttribute' => ['tipo_reclamacion' => 'id']],
       */ ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cant_reclamacion' => Yii::t('app', 'Cant Reclamacion'),
            'importe_reclamacion' => Yii::t('app', 'Importe Reclamacion'),
            'demanda_cant' => Yii::t('app', 'Demanda Cant'),
            'demanda_importe' => Yii::t('app', 'Demanda Importe'),
            'anexoid' => Yii::t('app', 'Anexoid'),
            'fecha' => Yii::t('app', 'Fecha'),
            'tipo_reclamacion' => Yii::t('app', 'Tipo Reclamacion'),
            'empresaid' => Yii::t('app', 'Empresaid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoReclamacion()
    {
        return $this->hasOne(TipoRelcamacion::className(), ['id' => 'tipo_reclamacion']);
    }
}
