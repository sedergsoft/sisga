<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cargo".
 *
 * @property int $id
 * @property string $cargo
 * @property string $salario
 *
 * @property Cuadro[] $cuadros
 * @property MovimientoCuadro[] $movimientoCuadros
 */
class Cargo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cargo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cargo', 'salario'], 'required'],
            [['cargo', 'salario'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cargo' => Yii::t('app', 'Cargo'),
            'salario' => Yii::t('app', 'Salario'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadros()
    {
        return $this->hasMany(Cuadro::className(), ['cargoid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoCuadros()
    {
        return $this->hasMany(MovimientoCuadro::className(), ['idcargo_propuesto' => 'id']);
    }
}
