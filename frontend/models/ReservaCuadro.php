<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reserva_cuadro".
 *
 * @property int $id
 * @property int $status
 * @property int $tipo_sel_reservaid
 * @property int $cuadroid
 * @property int $reservaid
 *
 * @property TipoSelReserva $tipoSelReserva
 * @property Cuadro $cuadro
 * @property Cuadro $reserva
 */
class ReservaCuadro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserva_cuadro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'tipo_sel_reservaid', 'cuadroid', 'reservaid'], 'integer'],
            [['tipo_sel_reservaid',  'reservaid'], 'required'],
            [['tipo_sel_reservaid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoSelReserva::className(), 'targetAttribute' => ['tipo_sel_reservaid' => 'id']],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
            [['reservaid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['reservaid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'tipo_sel_reservaid' => Yii::t('app', 'Tipo de Reserva'),
            'cuadroid' => Yii::t('app', 'Cuadro'),
            'reservaid' => Yii::t('app', 'Reserva'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoSelReserva()
    {
        return $this->hasOne(TipoSelReserva::className(), ['id' => 'tipo_sel_reservaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadroid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserva()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'reservaid']);
    }
}
