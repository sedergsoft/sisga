<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "confecionado".
 *
 * @property int $id
 * @property string $Nombre
 * @property int $idcargo
 *
 * @property CargosDireccion $cargo
 * @property EvaluacionCuadro[] $evaluacionCuadros
 */
class Confecionado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'confecionado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nombre', 'idcargo'], 'required'],
            [['idcargo'], 'integer'],
            [['Nombre'], 'string', 'max' => 255],
            [['idcargo'], 'exist', 'skipOnError' => true, 'targetClass' => CargosDireccion::className(), 'targetAttribute' => ['idcargo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Nombre' => Yii::t('app', 'Nombre'),
            'idcargo' => Yii::t('app', 'Cargo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargo()
    {
        return $this->hasOne(CargosDireccion::className(), ['id' => 'idcargo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionCuadros()
    {
        return $this->hasMany(EvaluacionCuadro::className(), ['confecionado' => 'id']);
    }
}
