<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "movimiento_cuadro".
 *
 * @property int $id
 * @property string $causas_sustitucion
 * @property string $sintesis_biografica
 * @property string $resultados_controles
 * @property string $fundamentacion
 * @property string $consideraciones
 * @property string $entidad
 * @property int $idcargo_propuesto
 * @property int $tipo_movimientoid
 * @property int $cuadroid
 * @property int $cuadro_sustituido
 * @property int $evaluacion_cuadroid
 * @property int $status
 * @property int $aprobada
 *
 * @property TipoMovimiento $tipoMovimiento
 * @property EvaluacionCuadro $evaluacionCuadro
 * @property Cuadro $cuadro
 * @property CargosDireccion $cargoPropuesto
 * @property Cuadro $cuadroSustituido
 */
class MovimientoCuadro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movimiento_cuadro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'sintesis_biografica', 'resultados_controles', 'fundamentacion', 'consideraciones', 'entidad', 'idcargo_propuesto', 'tipo_movimientoid', 'cuadro_sustituido', 'evaluacion_cuadroid'], 'required'],
            [['idcargo_propuesto','status','aprobada', 'tipo_movimientoid', 'cuadroid', 'cuadro_sustituido', 'evaluacion_cuadroid'], 'integer'],
            [['id'], 'integer'],
            [['sintesis_biografica', 'causas_sustitucion','resultados_controles', 'consideraciones'], 'string', 'max' => 2000],
            [['fundamentacion', 'entidad'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['tipo_movimientoid'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMovimiento::className(), 'targetAttribute' => ['tipo_movimientoid' => 'id']],
            [['evaluacion_cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => EvaluacionCuadro::className(), 'targetAttribute' => ['evaluacion_cuadroid' => 'id']],
            [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
            [['idcargo_propuesto'], 'exist', 'skipOnError' => true, 'targetClass' => CargosDireccion::className(), 'targetAttribute' => ['idcargo_propuesto' => 'id']],
            [['cuadro_sustituido'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadro_sustituido' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'causas_sustitucion' => Yii::t('app', 'Causas de la Sustitución'),
            'sintesis_biografica' => Yii::t('app', 'Síntesis Biográfica'),
            'resultados_controles' => Yii::t('app', 'Resultados de Controles'),
            'fundamentacion' => Yii::t('app', 'Fundamentación'),
            'consideraciones' => Yii::t('app', 'Consideraciones'),
            'entidad' => Yii::t('app', 'Entidad'),
            'idcargo_propuesto' => Yii::t('app', 'Cargo Propuesto'),
            'tipo_movimientoid' => Yii::t('app', 'Tipo de Movimiento'),
            'cuadroid' => Yii::t('app', 'Cuadro'),
            'cuadro_sustituido' => Yii::t('app', 'Cuadro Sustituido'),
            'evaluacion_cuadroid' => Yii::t('app', 'Evaluación de Cuadro'),
        ];
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
    public function getEvaluacionCuadro()
    {
        return $this->hasOne(EvaluacionCuadro::className(), ['id' => 'evaluacion_cuadroid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadroid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargoPropuesto()
    {
        return $this->hasOne(CargosDireccion::className(), ['id' => 'idcargo_propuesto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroSustituido()
    {
        return $this->hasOne(Cuadro::className(), ['id' => 'cuadro_sustituido']);
    }
}
