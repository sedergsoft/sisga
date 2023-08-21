<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reserva".
 *
 * @property int $id
 * @property int $tipo
 * @property string $observaciones
 *
 * @property EvaluacionCuadro[] $evaluacionCuadros
 * @property TipoReserva $tipo0
 */
class Reserva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'integer'],
            [['observaciones'], 'string', 'max' => 1000],
            [['tipo'], 'exist', 'skipOnError' => true, 'targetClass' => TipoReserva::className(), 'targetAttribute' => ['tipo' => 'id']],
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
            'observaciones' => Yii::t('app', 'Observaciones'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionCuadros()
    {
        return $this->hasMany(EvaluacionCuadro::className(), ['reservaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo0()
    {
        return $this->hasOne(TipoReserva::className(), ['id' => 'tipo']);
    }
}
