<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "entidad".
 *
 * @property int $id
 * @property string $nombre
 * @property string $nombre_corto
 * @property int $provincia_id
 * @property int $superiorid
 * @property int $status
 *
 * @property CuadroEntidad[] $cuadroEntidads
 * @property Provincia $provincia
 * @property Entidad $entidad
 */
class Entidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'provincia_id'], 'required'],
            [['provincia_id', 'superiorid', 'status'], 'integer'],
            [['nombre', 'nombre_corto'], 'string', 'max' => 255],
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
            'nombre_corto' => Yii::t('app', 'Nombre Comercial'),
            'provincia_id' => Yii::t('app', 'Provincia'),
            'superiorid' => Yii::t('app', 'Entidad Superior'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroEntidads()
    {
        return $this->hasMany(CuadroEntidad::className(), ['entidad_id' => 'id']);
    }

    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['id' => 'provincia_id']);
    }
    public function getEntidad()
    {
        return $this->hasOne(Entidad::className(), ['id' => 'superiorid']);
    }
}
