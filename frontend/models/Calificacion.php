<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "calificacion".
 *
 * @property int $id
 * @property string $calificacion
 */
class Calificacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calificacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['calificacion'], 'required'],
            [['calificacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'calificacion' => Yii::t('app', 'Calificacion'),
        ];
    }
}
