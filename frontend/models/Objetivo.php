<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "objetivo".
 *
 * @property int $id
 * @property string $orden
 * @property string $nombre
 * @property string $abreviatura
 * @property string $descripcion
 * @property string $fechaAct
 * @property int $responsable
 * @property int $Status
 * @property string $fechaDesac
 *
 * @property Criteriomedida[] $criteriomedidas
 * @property Direccion $responsable0
 */
class Objetivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objetivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'abreviatura', 'descripcion', 'fechaAct', 'responsable','orden'], 'required'],
            [['descripcion'], 'string'],
            [['fechaAct', 'fechaDesac'], 'safe'],
            [['responsable', 'Status','orden'], 'integer'],
            [['nombre'], 'string', 'max' => 1000],
            [['abreviatura'], 'string', 'max' => 5],
            [['responsable'], 'exist', 'skipOnError' => true, 'targetClass' => Direccion::className(), 'targetAttribute' => ['responsable' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'orden' => Yii::t('app', 'Número de orden'),
            'nombre' => Yii::t('app', 'Nombre'),
            'abreviatura' => Yii::t('app', 'Abreviatura'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'fechaAct' => Yii::t('app', 'Fecha Act'),
            'responsable' => Yii::t('app', 'Responsable'),
            'Status' => Yii::t('app', 'Status'),
            'fechaDesac' => Yii::t('app', 'Fecha Desac'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCriteriomedidas()
    {
        return $this->hasMany(Criteriomedida::className(), ['Objetivoid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsable0()
    {
        return $this->hasOne(Direccion::className(), ['id' => 'responsable']);
    }
}
