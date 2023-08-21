<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_venta".
 *
 * @property int $id
 * @property string $tipo_venta
 *
 * @property Ventas[] $ventas
 * @property Ventas[] $ventas0
 */
class TipoVenta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_venta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_venta'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_venta' => Yii::t('app', 'Tipo Venta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::className(), ['tipo_ventaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas0()
    {
        return $this->hasMany(Ventas::className(), ['tipo_ventaid' => 'id']);
    }
}
