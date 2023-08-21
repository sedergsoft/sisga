<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sentido".
 *
 * @property int $id
 * @property string $sentido
 *
 * @property TopeIndicador[] $topeIndicadors
 */
class Sentido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sentido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sentido'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sentido' => Yii::t('app', 'Sentido'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopeIndicadors()
    {
        return $this->hasMany(TopeIndicador::className(), ['idsentido' => 'id']);
    }
}
