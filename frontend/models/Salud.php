<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "salud".
 *
 * @property int $id
 * @property int $estado_saludid
 *
 * @property Cuadro[] $cuadros
 * @property EnfermedadSalud[] $enfermedadSaluds
 * @property Enfermedad[] $enfermedads
 * @property LimitacionesSalud[] $limitacionesSaluds
 * @property Limitaciones[] $limitaciones
 * @property EstadoSalud $estadoSalud
 */
class Salud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'salud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado_saludid'], 'required'],
            [['estado_saludid'], 'integer'],
            [['estado_saludid'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoSalud::className(), 'targetAttribute' => ['estado_saludid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'estado_saludid' => Yii::t('app', 'Estado Saludid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadros()
    {
        return $this->hasMany(Cuadro::className(), ['saludid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedadSaluds()
    {
        return $this->hasMany(EnfermedadSalud::className(), ['saludid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedads()
    {
        return $this->hasMany(Enfermedad::className(), ['id' => 'enfermedadid'])->viaTable('enfermedad_salud', ['saludid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitacionesSaluds()
    {
        return $this->hasMany(LimitacionesSalud::className(), ['saludid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitaciones()
    {
        return $this->hasMany(Limitaciones::className(), ['id' => 'limitacionesid'])->viaTable('limitaciones_salud', ['saludid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoSalud()
    {
        return $this->hasOne(EstadoSalud::className(), ['id' => 'estado_saludid']);
    }
}
