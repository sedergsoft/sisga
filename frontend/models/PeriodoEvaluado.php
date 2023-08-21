<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "periodo_evaluado".
 *
 * @property int $id
 * @property string $desde
 * @property string $hasta
 *
 * @property EvaluacionCuadro[] $evaluacionCuadros
 */
class PeriodoEvaluado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'periodo_evaluado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desde', 'hasta'], 'safe'],
            [['desde', 'hasta'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'desde' => Yii::t('app', 'Desde'),
            'hasta' => Yii::t('app', 'Hasta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionCuadros()
    {
        return $this->hasMany(EvaluacionCuadro::className(), ['periodo_evaluadoid' => 'id']);
    }
}
