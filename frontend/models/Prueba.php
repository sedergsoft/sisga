<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "prueba".
 *
 * @property int $id
 * @property string $pais
 * @property string $ciudad
 * @property int $municipio
 */
class Prueba extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prueba';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id', 'pais', 'ciudad', 'municipio'], 'required'],
            [['id', 'municipio'], 'integer'],
            [['pais', 'ciudad'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pais' => Yii::t('app', 'Pais'),
            'ciudad' => Yii::t('app', 'Ciudad'),
            'municipio' => Yii::t('app', 'Municipio'),
        ];
    }
}
