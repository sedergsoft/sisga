<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id
 * @property string $producto
 * @property string $UM
 *
 * @property Ventas[] $ventas
 * @property Ventas[] $ventas0
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['producto', 'UM'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'producto' => Yii::t('app', 'Producto'),
            'UM' => Yii::t('app', 'U M'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::className(), ['productoid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas0()
    {
        return $this->hasMany(Ventas::className(), ['productoid' => 'id']);
    }
}
