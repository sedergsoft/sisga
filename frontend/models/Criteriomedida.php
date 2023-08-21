<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "criteriomedida".
 *
 * @property int $id
 * @property int $orden
 * @property string $Descripcion
 * @property string $UM
 * @property int $status
 * @property int $Objetivoid
 * @property int $direccionid
 * @property int $topeid
 * @property int $editable
 * @property int $evaluado
 * 
 * @property Direccion $direccion
 * @property Objetivo $objetivo
 * @property Tope $tope
 * @property Evaluacion[] $evaluacions
 */
class Criteriomedida extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'criteriomedida';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orden', 'Descripcion', 'UM', 'Objetivoid', 'direccionid'], 'required'],
            [['orden', 'status', 'Objetivoid', 'direccionid', 'topeid','editable'], 'integer'],
            [['Descripcion'], 'string', 'max' => 1000],
            [['UM'], 'string', 'max' => 255],
            [['direccionid'], 'exist', 'skipOnError' => true, 'targetClass' => Direccion::className(), 'targetAttribute' => ['direccionid' => 'id']],
            [['Objetivoid'], 'exist', 'skipOnError' => true, 'targetClass' => Objetivo::className(), 'targetAttribute' => ['Objetivoid' => 'id']],
            [['topeid'], 'exist', 'skipOnError' => true, 'targetClass' => Tope::className(), 'targetAttribute' => ['topeid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'orden' => Yii::t('app', 'No. Orden'),
            'Descripcion' => Yii::t('app', 'Descripcion'),
            'UM' => Yii::t('app', 'UM'),
            'status' => Yii::t('app', 'Status'),
            'Objetivoid' => Yii::t('app', 'Objetivo'),
            'direccionid' => Yii::t('app', 'Dirección'),
            'topeid' => Yii::t('app', 'Tope'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireccion()
    {
        return $this->hasOne(Direccion::className(), ['id' => 'direccionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivo()
    {
        return $this->hasOne(Objetivo::className(), ['id' => 'Objetivoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTope()
    {
        return $this->hasOne(Tope::className(), ['id' => 'topeid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacions()
    {
        return $this->hasMany(Evaluacion::className(), ['criteriomedidaid' => 'id']);
    }
}
