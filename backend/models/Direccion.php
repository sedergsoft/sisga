<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "direccion".
 *
 * @property int $id
 * @property string $nombre
 * @property string $responsable
 * @property int $Status
 *
 * @property Criteriomedida[] $criteriomedidas
 * @property Evaluacion[] $evaluacions
 * @property Objetivo[] $objetivos
 * @property User[] $users
 */
class Direccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'direccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'responsable'], 'required'],
            [['Status'], 'integer'],
            [['nombre', 'responsable'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'responsable' => Yii::t('app', 'Responsable'),
            'Status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCriteriomedidas()
    {
        return $this->hasMany(Criteriomedida::className(), ['direccionid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacions()
    {
        return $this->hasMany(Evaluacion::className(), ['direccionid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivos()
    {
        return $this->hasMany(Objetivo::className(), ['responsable' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['direccionid' => 'id']);
    }
}
