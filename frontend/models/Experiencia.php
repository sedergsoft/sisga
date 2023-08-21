<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "experiencia".
 *
 * @property int $id
 * @property int $años_cargo_actual
 * @property int $meses_cargo_actual
 * @property int $años_cuadro
 * @property int $meses_cuadro
 *
 * @property EvaluacionCuadro[] $evaluacionCuadros
 */
class Experiencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'experiencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['años_cargo_actual', 'meses_cargo_actual', 'años_cuadro', 'meses_cuadro'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'años_cargo_actual' => Yii::t('app', 'Años en el Cargo Actual'),
            'meses_cargo_actual' => Yii::t('app', 'Meses en el Cargo Actual'),
            'años_cuadro' => Yii::t('app', 'Años como Cuadro'),
            'meses_cuadro' => Yii::t('app', 'Meses como Cuadro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionCuadros()
    {
        return $this->hasMany(EvaluacionCuadro::className(), ['experienciaid' => 'id']);
    }
}
