<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "municipio".
 *
 * @property int $id
 * @property string $municipio
 * @property int $provinciaid
 *
 * @property CentroEstudios[] $centroEstudios
 * @property Direcciones[] $direcciones
 * @property Provincia $provincia
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'municipio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['municipio', 'provinciaid'], 'required'],
            [['provinciaid'], 'integer'],
            [['municipio'], 'string', 'max' => 255],
            [['provinciaid'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['provinciaid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'municipio' => Yii::t('app', 'Municipio'),
            'provinciaid' => Yii::t('app', 'Provinciaid'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroEstudios()
    {
        return $this->hasMany(CentroEstudios::className(), ['municipioid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirecciones()
    {
        return $this->hasMany(Direcciones::className(), ['municipioid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['id' => 'provinciaid']);
    }
}
