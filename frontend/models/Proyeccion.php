<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "proyeccion".
 *
 * @property int $id
 * @property int $tipo_proyeccionid
 * @property int $tipo_movimientoid
 *
 * @property EvaluacionCuadro[] $evaluacionCuadros
 * @property TipoMovimiento $tipoMovimiento
 * @property TipoProyeccion $tipoProyeccion
 */
class Proyeccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyeccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_proyeccionid'], 'required'],
            [['tipo_proyeccionid', 'tipo_movimientoid'], 'integer'],
            [['tipo_movimientoid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMovimiento::className(), 'targetAttribute' => ['tipo_movimientoid' => 'id']],
            [['tipo_proyeccionid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProyeccion::className(), 'targetAttribute' => ['tipo_proyeccionid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_proyeccionid' => Yii::t('app', 'Proyección'),
            'tipo_movimientoid' => Yii::t('app', 'Tipo de Movimiento'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionCuadros()
    {
        return $this->hasMany(EvaluacionCuadro::className(), ['proyeccionid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMovimiento()
    {
        return $this->hasOne(TipoMovimiento::className(), ['id' => 'tipo_movimientoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoProyeccion()
    {
        return $this->hasOne(TipoProyeccion::className(), ['id' => 'tipo_proyeccionid']);
    }
}
