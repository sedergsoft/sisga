<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "escuela_politica".
 *
 * @property int $id
 * @property string $escuela
 *
 * @property CuadroEscuelaPolitica[] $cuadroEscuelaPoliticas
 */
class EscuelaPolitica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'escuela_politica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['escuela'], 'required'],
            [['escuela'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'escuela' => Yii::t('app', 'Escuela'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadroEscuelaPoliticas()
    {
        return $this->hasMany(CuadroEscuelaPolitica::className(), ['escuela_politicaid' => 'id']);
    }
}
