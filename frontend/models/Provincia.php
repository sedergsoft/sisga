<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "provincia".
 *
 * @property int $id
 * @property string $provincia
 *
 * @property CentroEstudios[] $centroEstudios
 * @property Direcciones[] $direcciones
 * @property Municipio[] $municipios
 */
class Provincia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provincia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provincia'], 'required'],
            [['provincia'], 'string', 'max' => 255],
            [['provincia'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'provincia' => Yii::t('app', 'Provincia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentroEstudios()
    {
        return $this->hasMany(CentroEstudios::className(), ['provinciaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirecciones()
    {
        return $this->hasMany(Direcciones::className(), ['provinciaid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasMany(Municipio::className(), ['provinciaid' => 'id']);
    }
}
