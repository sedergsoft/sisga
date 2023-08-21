<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "evaluacion_cuadro".
 *
 * @property int $id
 * @property string $complemento_textual
 * @property string $señalamientos
 * @property string $concluciones
 * @property string $recomendaciones
 * @property string $resultado_evaluacion
 * @property string $superacion
 * @property string $confecionado
 * @property string $entidad
 * @property string $fecha
 * @property int $cuadroid
 * @property int $reservaid
 * @property int $proyeccionid
 * @property int $opinion_evaluadoid
 * @property int $experienciaid
 * @property int $periodo_evaluadoid
 * @property int $organismoidorganismo
 *@property int $ultima
 * 
 *
 * @property Confecionado $confecionado0
 * @property Cuadro $cuadro
 * @property PeriodoEvaluado $periodoEvaluado
 * @property Proyeccion $proyeccion
 * @property Reserva $reserva
 * @property OpinionEvaluado $opinionEvaluado
 * @property Experiencia $experiencia
 * @property EvaluacionCuadroIndicadoresEvaluacion[] $evaluacionCuadroIndicadoresEvaluacions
 * @property MovimientoCuadro[] $movimientoCuadros
 */
class EvaluacionCuadro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluacion_cuadro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['complemento_textual','superacion', 'señalamientos','recomendaciones' ,'concluciones','fecha', 'entidad'], 'string'],
           [['complemento_textual', 'señalamientos','recomendaciones' ,'concluciones'], 'required'],
            //[['cuadroid', 'reservaid', 'proyeccionid', 'opinion_evaluadoid', 'experienciaid', 'periodo_evaluadoid', 'organismoidorganismo'], 'required'],
            [['cuadroid','resultado_evaluacion', 'reservaid', 'proyeccionid', 'opinion_evaluadoid', 'experienciaid', 'periodo_evaluadoid', 'organismoidorganismo','ultima'], 'integer'],
            //[['confecionado'], 'exist', 'skipOnError' => true, 'targetClass' => Confecionado::className(), 'targetAttribute' => ['confecionado' => 'id']],
             [['cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadro::className(), 'targetAttribute' => ['cuadroid' => 'id']],
            [['periodo_evaluadoid'], 'exist', 'skipOnError' => true, 'targetClass' => PeriodoEvaluado::className(), 'targetAttribute' => ['periodo_evaluadoid' => 'id']],
            [['proyeccionid'], 'exist', 'skipOnError' => true, 'targetClass' => Proyeccion::className(), 'targetAttribute' => ['proyeccionid' => 'id']],
            [['reservaid'], 'exist', 'skipOnError' => true, 'targetClass' => Reserva::className(), 'targetAttribute' => ['reservaid' => 'id']],
            [['opinion_evaluadoid'], 'exist', 'skipOnError' => true, 'targetClass' => OpinionEvaluado::className(), 'targetAttribute' => ['opinion_evaluadoid' => 'id']],
            [['experienciaid'], 'exist', 'skipOnError' => true, 'targetClass' => Experiencia::className(), 'targetAttribute' => ['experienciaid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'complemento_textual' => Yii::t('app', 'Complemento Textual'),
            'señalamientos' => Yii::t('app', 'Señalamientos'),
            'concluciones' => Yii::t('app', 'Concluciones'),
            'concluciones' => Yii::t('app', 'Recomendaciones'),
            'resultado_evaluacion' => Yii::t('app', 'Resultado Evaluacion'),
            'superacion' => Yii::t('app', 'Para su preparación y superación:     '),
            'confecionado' => Yii::t('app', 'Confecionado'),
            'entidad' => Yii::t('app', 'Entidad'),
            'cuadroid' => Yii::t('app', 'Cuadro'),
            'reservaid' => Yii::t('app', 'Reserva'),
            'proyeccionid' => Yii::t('app', 'Proyeccion'),
            'opinion_evaluadoid' => Yii::t('app', 'Opinion del Evaluado'),
            'experienciaid' => Yii::t('app', 'Experiencia'),
            'periodo_evaluadoid' => Yii::t('app', 'Periodo Evaluadoid'),
            'organismoidorganismo' => Yii::t('app', 'Organismo'),
        ];
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
    public function getPeriodoEvaluado()
    {
        return $this->hasOne(PeriodoEvaluado::className(), ['id' => 'periodo_evaluadoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyeccion()
    {
        return $this->hasOne(Proyeccion::className(), ['id' => 'proyeccionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserva()
    {
        return $this->hasOne(Reserva::className(), ['id' => 'reservaid']);
    }
 public function getConfecionado0()
    {
        return $this->hasOne(Confecionado::className(), ['id' => 'confecionado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpinionEvaluado()
    {
        return $this->hasOne(OpinionEvaluado::className(), ['id' => 'opinion_evaluadoid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperiencia()
    {
        return $this->hasOne(Experiencia::className(), ['id' => 'experienciaid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionCuadroIndicadoresEvaluacions()
    {
        return $this->hasMany(EvaluacionCuadroIndicadoresEvaluacion::className(), ['evaluacion_cuadroid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoCuadros()
    {
        return $this->hasMany(MovimientoCuadro::className(), ['evaluacion_cuadroid' => 'id']);
    }
}
