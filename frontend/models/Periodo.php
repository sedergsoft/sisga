<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "periodo".
 *
 * @property int $id
 * @property string $periodo
 *
 * @property Evaluacion[] $evaluacions
 */
class Periodo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'periodo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['periodo'], 'required'],
            [['periodo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'periodo' => Yii::t('app', 'Periodo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacions()
    {
        return $this->hasMany(Evaluacion::className(), ['periodo' => 'id']);
    }
}
