<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "grado_cientifico".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property PreparacionIntelectual[] $preparacionIntelectuals
 */
class GradoCientifico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grado_cientifico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo' => Yii::t('app', 'Tipo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreparacionIntelectuals()
    {
        return $this->hasMany(PreparacionIntelectual::className(), ['grado_cientifico' => 'id']);
    }
}
