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
 * @property Cuadro[] $cuadros
 * @property CuadroEntidad[] $cuadroEntidads
 * @property EvaluacionCuadro[] $evaluacionCuadros
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
            'nombre_corto' => Yii::t('app', 'Nombre Corto'),
            'provincia_id' => Yii::t('app', 'Provincia ID'),
            'superiorid' => Yii::t('app', 'Superiorid'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadros()
    {
        return $this->hasMany(Cuadro::className(), ['entidadid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroEntidads()
    {
        return $this->hasMany(CuadroEntidad::className(), ['entidad_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionCuadros()
    {
        return $this->hasMany(EvaluacionCuadro::className(), ['entidadid' => 'id']);
    }
}
