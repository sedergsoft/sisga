<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_movimiento".
 *
 * @property int $id
 * @property string $tipo_movimiento
 *
 * @property MovimientoCuadro[] $movimientoCuadros
 */
class TipoMovimiento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_movimiento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_movimiento'], 'required'],
            [['tipo_movimiento'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_movimiento' => Yii::t('app', 'Tipo de Movimiento'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoCuadros()
    {
        return $this->hasMany(MovimientoCuadro::className(), ['tipo_movimientoid' => 'id']);
    }
}
