<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "enfermedad_salud".
 *
 * @property int $enfermedadid
 * @property int $saludid
 *
 * @property Enfermedad $enfermedad
 * @property Salud $salud
 */
class EnfermedadSalud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enfermedad_salud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['enfermedadid', 'saludid'], 'required'],
            [['enfermedadid', 'saludid'], 'integer'],
           // [['enfermedadid', 'saludid'], 'unique', 'targetAttribute' => ['enfermedadid', 'saludid']],
           // [['enfermedadid'], 'exist', 'skipOnError' => true, 'targetClass' => Enfermedad::className(), 'targetAttribute' => ['enfermedadid' => 'id']],
           // [['saludid'], 'exist', 'skipOnError' => true, 'targetClass' => Salud::className(), 'targetAttribute' => ['saludid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'enfermedadid' => Yii::t('app', 'Enfermedadid'),
            'saludid' => Yii::t('app', 'Saludid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedad()
    {
        return $this->hasOne(Enfermedad::className(), ['id' => 'enfermedadid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalud()
    {
        return $this->hasOne(Salud::className(), ['id' => 'saludid']);
    }
}
