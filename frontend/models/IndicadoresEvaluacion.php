<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "indicadores_evaluacion".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $active
 * 
 *
 * @property EvaluacionCuadroIndicadoresEvaluacion[] $evaluacionCuadroIndicadoresEvaluacions
 */
class IndicadoresEvaluacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indicadores_evaluacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['descripcion'], 'string', 'max' => 1000],
            [['active'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionCuadroIndicadoresEvaluacions()
    {
        return $this->hasMany(EvaluacionCuadroIndicadoresEvaluacion::className(), ['Indicadores_evaluacionid' => 'id']);
    }
}
