<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "evaluacion_cuadro_indicadores_evaluacion".
 *
 * @property int $id
 * @property int $evaluacion_cuadroid
 * @property int $Indicadores_evaluacionid
 * @property string $evaluacion
 *
 * @property IndicadoresEvaluacion $indicadoresEvaluacion
 * @property EvaluacionCuadro $evaluacionCuadro
 */
class EvaluacionCuadroIndicadoresEvaluacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluacion_cuadro_indicadores_evaluacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['evaluacion_cuadroid', 'Indicadores_evaluacionid'], 'required'],
            [['evaluacion_cuadroid', 'Indicadores_evaluacionid'], 'integer'],
            [['evaluacion'], 'string', 'max' => 255],
            [['Indicadores_evaluacionid'], 'exist', 'skipOnError' => true, 'targetClass' => IndicadoresEvaluacion::className(), 'targetAttribute' => ['Indicadores_evaluacionid' => 'id']],
            [['evaluacion_cuadroid'], 'exist', 'skipOnError' => true, 'targetClass' => EvaluacionCuadro::className(), 'targetAttribute' => ['evaluacion_cuadroid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'evaluacion_cuadroid' => Yii::t('app', 'Evaluacion Cuadroid'),
            'Indicadores_evaluacionid' => Yii::t('app', 'Indicadores Evaluacionid'),
            'evaluacion' => Yii::t('app', 'Evaluacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicadoresEvaluacion()
    {
        return $this->hasOne(IndicadoresEvaluacion::className(), ['id' => 'Indicadores_evaluacionid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionCuadro()
    {
        return $this->hasOne(EvaluacionCuadro::className(), ['id' => 'evaluacion_cuadroid']);
    }
}
