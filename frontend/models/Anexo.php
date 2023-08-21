<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "anexo".
 *
 * @property int $id
 * @property string $anexo
 * @property string $tabla
 * @property string $modelo
 * @property string $searchmodel
 *
 * @property EvaluacionAnexo[] $evaluacionAnexos
 */
class Anexo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anexo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['modelo', 'searchmodel'], 'required'],
            [['anexo', 'tabla', 'modelo', 'searchmodel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'anexo' => Yii::t('app', 'Anexo'),
            'tabla' => Yii::t('app', 'Tabla'),
            'modelo' => Yii::t('app', 'Modelo'),
            'searchmodel' => Yii::t('app', 'Searchmodel'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacionAnexos()
    {
        return $this->hasMany(EvaluacionAnexo::className(), ['anexoid' => 'id']);
    }
}
