<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "opinion_evaluado".
 *
 * @property int $id
 * @property string $opinion
 * @property int $reclamacion
 * @property string $reclamacion_desc
 *
 * @property EvaluacionCuadro[] $evaluacionCuadros
 */
class OpinionEvaluado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opinion_evaluado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reclamacion'], 'required'],
            [['reclamacion'], 'integer'],
            [['opinion', 'reclamacion_desc'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'opinion' => Yii::t('app', 'Conformidad'),
            'reclamacion' => Yii::t('app', '¿Reclama?'),
            'reclamacion_desc' => Yii::t('app', 'Reclamación'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionCuadros()
    {
        return $this->hasMany(EvaluacionCuadro::className(), ['opinion_evaluadoid' => 'id']);
    }
}
