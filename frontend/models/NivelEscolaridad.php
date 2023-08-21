<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "nivel_escolaridad".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property PreparacionIntelectual[] $preparacionIntelectuals
 */
class NivelEscolaridad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nivel_escolaridad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tipo'], 'required'],
            [['id'], 'integer'],
            [['tipo'], 'string', 'max' => 100],
            [['id'], 'unique'],
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
        return $this->hasMany(PreparacionIntelectual::className(), ['nivel_escolaridad' => 'id']);
    }
}
