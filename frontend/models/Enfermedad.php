<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "enfermedad".
 *
 * @property int $id
 * @property string $enfermedad
 * @property string $tratamiento
 * @property string $status
 * 
 *
 * @property EnfermedadSalud[] $enfermedadSaluds
 * @property Salud[] $saluds
 */
class Enfermedad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enfermedad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            
            [['enfermedad','tratamiento'], 'string', 'max' => 1000],
            [['enfermedad'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'enfermedad' => Yii::t('app', 'Enfermedad'),
            'tratamiento' => Yii::t('app', 'Tratamiento'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnfermedadSaluds()
    {
        return $this->hasMany(EnfermedadSalud::className(), ['enfermedadid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaluds()
    {
        return $this->hasMany(Salud::className(), ['id' => 'saludid'])->viaTable('enfermedad_salud', ['enfermedadid' => 'id']);
    }
}
