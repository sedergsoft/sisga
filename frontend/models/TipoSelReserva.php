<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tipo_sel_reserva".
 *
 * @property int $id
 * @property string $tipo
 * @property string $status
 *
 * @property ReservaCuadro[] $reservaCuadros
 */
class TipoSelReserva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_sel_reserva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo' => Yii::t('app', 'Tipo'),
            'status' => Yii::t('app', 'status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservaCuadros()
    {
        return $this->hasMany(ReservaCuadro::className(), ['tipo_sel_reservaid' => 'id']);
    }
}
